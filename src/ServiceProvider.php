<?php

namespace AltDesign\AltAdminBar;

// Providers
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
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

    public function bootAddon()
    {

    }
}

