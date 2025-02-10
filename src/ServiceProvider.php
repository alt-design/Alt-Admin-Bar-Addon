<?php

namespace AltDesign\AltAdminBar;

// Providers
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function __construct($app)
    {
        parent::__construct($app);
    }


    protected $vite = [
        'input' => [
            'resources/js/alt-admin-bar.js',
            'resources/css/alt-admin-bar.css'
        ],
        'publicDirectory' => 'resources/dist',
    ];


    protected $tags = [
        \AltDesign\AltAdminBar\Tags\AltAdminBar::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \AltDesign\AltAdminBar\Http\Middleware\InjectAdminBar::class,
        ]
    ];

    public function bootAddon()
    {
        $this->loadViewsFrom('../resources/views', 'alt-admin-bar');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/alt-admin-bar'),
        ]);
    }
}

