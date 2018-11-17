<?php

namespace App\Traits;

use App\User;
use EveSSO\EveSSO;
use EveSSO\CorporationPublic;
use EveSSO\CharacterRoles;

trait CorporationRoles {
    public function hasCorporationRole(EveSSO $sso, string $role) {
        
        $has_role = CharacterRoles::whereJsonContains('roles', $role)->where('character_id', $sso->character_id)->first();

        return $has_role ? true : false;
    }

    public function getFirstWithCorporateRole(CorporationPublic $corp, string $role) {
        $role = CharacterRoles::whereJsonContains('roles', 'Factory_Manager')
            ->whereHas('character', function($q) use ($corp) {
                $q->where('corporation_id', $corp->corporation_id);
            })
            ->first();

        if ($role) {
            return $role->sso;
        }
        return null;
    }
}