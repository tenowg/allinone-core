<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ViewModels\PermissionDefinitions\Permissions;

class PermissionsProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Permissions $perms)
    {
        $perms->addPermission('superUser', 'A very rare permission given only to those that can do everything.');
        
        $perms->addPermission('hasAdminRights', 'This permission is required to do anything with admin permissions, such as edit/view permissions, etc');
        $perms->addPermission('viewPermissionGroup', 'Allowed to view the permission groups (admin right)');
        $perms->addPermission('createPermissionGroup', 'Allowed to create permission Groups. (usually assigned with editPermissionGroup) (admin right)');
        $perms->addPermission('editPermissionGroup', 'Able to edit permission Groups (admin right)');
        $perms->addPermission('deletePermissionGroup', 'Able to delete Permission Groups. (admin right)');

        $perms->addPermission('viewOwnCorporation', 'Basic access to view a players own Corporations Public information, required in addition to other corporation related permissions');
        $perms->addPermission('viewOtherCorporation', 'Basic access to view other Corporations Public information, required in addition to other corporation related permissions');
        $perms->addPermission('joinOwnCorporation', 'Allowed to join the Corporations Notification Channel');
        $perms->addPermission('joinOtherCorporation', 'Allowed to join other corporations other than thier own.');

        $perms->addPermission('viewOwnAlliance', 'Basic access to view a players own Alliance, basic permission to view more detailed information');
        $perms->addPermission('viewOtherAlliance', 'Basic access to view other alliances, basic permission needed to view more detailed infomation');

        $perms->addPermission('viewOwnProfile', 'Allowed to view thier own profile, Basic permission that allows other permission to add more functions.');
        $perms->addPermission('editOwnProfile', 'Allowed to edit thier own profile');
        $perms->addPermission('viewOwnStats', 'Can view thier own game stats');
        
        $perms->addPermission('viewOtherProfiles', 'Allowed to view other players profiles, Basic permission that allows other permission to add more functiona');
        $perms->addPermission('editOtherProfiles', 'Allowed to edit other players profiles');
        $perms->addPermission('viewOtherStats', 'Allowed to view other players game stats');

        $perms->addPermission('viewOwnIndustryJobs', 'Allowed to view their own industry jobs');
        $perms->addPermission('viewOwnCorporationIndustryJobs', 'Allowed to view their corporations industry jobs');
        $perms->addPermission('viewOtherCorporationsIndustryJobs', 'Allowed to view other corporations industry jobs');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Permissions::class, function() {
            return new Permissions();
        });
    }
}
