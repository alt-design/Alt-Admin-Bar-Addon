<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar;

use AltDesign\AltAdminBar\Helpers\Data;
use Statamic\Filesystem\Manager;
use Statamic\Stache\Stache;
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

        if (!config('statamic.revisions.enabled')) {
            return;
        }

        $this->app->extend(
            \Statamic\Contracts\Entries\EntryRepository::class,
            function ($base, $app) {
                return new \AltDesign\AltAdminBar\Decorators\EntryRepositoryDecorator(
                    base: $base,
                    stache: resolve(Stache::class)
                );
            }
        );
    }
}
