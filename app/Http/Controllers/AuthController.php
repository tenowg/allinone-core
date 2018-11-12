<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use EveEsi\Character;
use App\User;
use App\Jobs\UpdateCharacterJob;

class AuthController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var Character
     */
    private $esi_char;

    public function __construct(Character $esi_char)
    {
        $this->middleware('auth:api', ['except' => ['login', 'evelogin', 'evecallback', 'refresh']]);
        $this->esi_char = $esi_char;
    }

    /**
     * Child will be redirected to this url
     */
    public function evelogin() {
        $scopes = config('eve-sso.scopes');
        return Socialite::driver('eveonline')
            ->setScopes($scopes)
            ->redirect();
    }

    public function refresh() {
        return auth()->refresh();
    }

    /**
     * child will process and then child needs to tell parent the code.
     */
    public function evecallback() {
        $user = Socialite::driver('eveonline')->user();

        $authUser = $this->findOrCreateUser($user, 'eveonline');

        $token = auth()->login($authUser);
        return view('auth.token', compact('token', 'authUser'));
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        //$settings = Settings::first();
        $sso = Socialite::driver('eveonline')->handleDatabase($user);
        
        $authUser = User::where('sso_id', $user->id)->first();

        if ($authUser == null) {
            $authUser =  User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'character_id' => $user->id,
                'sso_id' => $user->id
            ]);    
        }

        //$this->esi_char->getCharacterPublic($authUser->sso);
        UpdateCharacterJob::dispatch($authUser->sso);

        return $authUser;
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
