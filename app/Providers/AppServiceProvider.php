<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Candidate;
use App\Partylist;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION',
            [
                'text' => 'Candidates',
                'url'  => 'admin/candidates',
                'icon'  => 'user-circle',
                'label' => Candidate::count(),
            ],
            [
                'text'        => 'Positions',
                'url'         => 'admin/positions',
                'icon'        => 'industry',
            ],
            [
                'text'        => 'Colleges',
                'url'         => 'admin/colleges',
                'icon'        => 'building-o',
            ],
            [
                'text'        => 'Party List',
                'url'         => 'admin/party-lists',
                'icon'        => 'users',
                'label'       => Partylist::count(),
            ],
            [
                'text'        => 'Votes',
                'url'         => 'admin/votes',
                'icon'        => 'vcard',
            ],
            [
                'text'        => 'Chart',
                'url'         => 'admin/chart',
                'icon'        => 'pie-chart',
            ],
            'ACCOUNT SETTINGS',
            [
                'text' => 'Settings',
                'url'  => 'admin/user',
                'icon' => 'user',
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
