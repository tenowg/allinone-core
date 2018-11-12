<?php

namespace App\Broadcasting;

use App\User;
use EveSSO\CorporationPublic;

/**
 * Channel for updating Corporation Public information
 */
class CorporationChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user, CorporationPublic $corp)
    {
        return $user->can('join', $corp);
    }
}
