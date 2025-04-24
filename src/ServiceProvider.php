<?php

namespace AltDesign\AltAdminBar;

use AltDesign\AltAdminBar\Listeners\HandleMenuItems;
use Illuminate\Support\Facades\Event;
use Statamic\Providers\AddonServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package  AltDesign\AltAdminBar
 * @author   Ben Harvey <ben@alt-design.net>, Benammi Swift <benammi@alt-design.net>, Lucy Ahmed <lucy@alt-design.net>
 * @license  Copyright (C) Alt Design Limited - All Rights Reserved - licensed under the MIT license
 * @link     https://alt-design.net
 */
class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/css/alt-admin-bar.css'
        ],
        'publicDirectory' => 'resources/dist',
    ];


    protected $tags = [
        \AltDesign\AltAdminBar\Tags\AltAdminBar::class,
    ];

    public function bootAddon()
    {
        $this->loadViewsFrom('../resources/views', 'alt-admin-bar');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/alt-admin-bar'),
        ]);

        (new BindingManager(
            app: app()
        ))->register();
    }
}

