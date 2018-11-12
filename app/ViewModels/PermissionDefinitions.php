<?php

namespace App\ViewModels\PermissionDefinitions;

class Permissions {
    public $permissions = [];

    public function addPermission(string $name, string $description) {
        array_push($this->permissions, new Perm($name, $description));
    }
}

class Perm {
    public $permission;
    public $description;

    public function __construct(string $name, string $description)
    {
        $this->permission = $name;
        $this->description = $description;
    }
}