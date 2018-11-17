<?php
use EveEsi\Scopes;

return [
    'database' => env('EVE_SSO_DATABASE', 'mysql'),
    'baseurl' => 'https://esi.evetech.net/latest/',
    'useragent' => 'Eve ESI Laravel package (Jenny Dawn)',
    'commit_data' => true,
    'scopes' => [
        Scopes::READ_NOTIFICATIONS,
        Scopes::READ_CHARACTER_ROLES,
        Scopes::READ_CHARACTER_TITLES,
        Scopes::READ_CHARACTER_STATS,
        Scopes::READ_CHARACTER_SKILLS,
        Scopes::READ_CHARACTER_WALLET,
        Scopes::READ_CHARACTER_INDUSTRY_JOBS,
        Scopes::READ_CHARACTER_ASSETS,
        Scopes::READ_CORP_INDUSTRY_JOBS,
        Scopes::READ_CORP_ASSETS,
    ],
    'main_host' => true
];