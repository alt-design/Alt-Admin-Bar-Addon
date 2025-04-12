<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar;

use AltDesign\AltAdminBar\Helpers\Data;
use Statamic\Filesystem\Manager;
use Statamic\Yaml\Yaml;

// Binds stuff to the service container, split out here to keep service provider tidy and be testable
class BindingManager
{
    public function __construct(
        private mixed $app
    ) {
        //
    }

    public function register(): void
    {
        $this->app->bind(Data::class, function ($app) {
            return new Data(
                manager: resolve(Manager::class),
                yaml: resolve(Yaml::class)
            );
        });
    }
}
