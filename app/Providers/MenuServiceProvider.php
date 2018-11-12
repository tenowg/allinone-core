<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ViewModels\MenuViewModels\Menu;
use App\ViewModels\MenuViewModels\Section;
use App\ViewModels\MenuViewModels\SubMenu;
use App\ViewModels\MenuViewModels\MenuItem;
use App\Traits\Permissions;

class MenuServiceProvider extends ServiceProvider
{
    use Permissions;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Menu $menu)
    {
        $user = \Auth::user();

        if ($user && $this->hasPermission($user, 'hasAdminRights')) {
            $admin = new Section('Admin');

            $general = new SubMenu('General Settings', 'fa fa-edit');
            $general->addItem(new MenuItem('Users', 'user'));
            
            if ($user && $this->hasPermission($user, 'viewPermissionGroup')) {
                $general->addItem(new MenuItem('Permissions', 'admin/permissions'));
            }
            
            $admin->addItem($general);

            $menu->addItem($admin);
        }

        // user section
        $general_section = new Section('General');
        $test = new SubMenu('Test', 'fa fa-edit');
        $test->addItem(new MenuItem('test', 'test'));
        $general_section->addItem($test);
        if ($user && $this->hasPermission($user, 'viewOwnProfile')) {
            $profile = new SubMenu('Profile', 'fa fa-edit');
            $profile->addItem(new MenuItem('Profile', 'user/profile/' . $user->sso->character_id));
            if ($this->hasPermission($user, 'viewOwnCorporation')) {
                $profile->addItem(new MenuItem('Corporation', 'corp/' . $user->sso->characterPublic->corporation_id));
            }
            $general_section->addItem($profile);
        }

        $menu->addItem($general_section);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Menu::class, function() {
            return new Menu();
        });
    }
}
