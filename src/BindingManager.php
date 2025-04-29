<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar;

use AltDesign\AltAdminBar\Helpers\Data;
use AltDesign\AltAdminBar\Extend\Data as DataExtension;
use Statamic\Contracts\Data\DataRepository;
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

        $this->app->bind(DataExtension::class, function ($app) {
            return new DataExtension();
        });

        $this->app->bind(DataRepository::class, function ($app) {
            return (new DataExtension())
                ->setRepository('entry', \Statamic\Contracts\Entries\EntryRepository::class)
                ->setRepository('term', \Statamic\Contracts\Taxonomies\TermRepository::class)
                ->setRepository('collection', \Statamic\Contracts\Entries\CollectionRepository::class)
                ->setRepository('taxonomy', \Statamic\Contracts\Taxonomies\TaxonomyRepository::class)
                ->setRepository('global', \Statamic\Contracts\Globals\GlobalRepository::class)
                ->setRepository('asset', \Statamic\Contracts\Assets\AssetRepository::class)
                ->setRepository('user', \Statamic\Contracts\Auth\UserRepository::class);
        });

        $this->app->singleton(
            \Statamic\Contracts\Entries\EntryRepository::class,
            \AltDesign\AltAdminBar\Extend\EntryRepository::class
        );

        $this->app->singleton(\AltDesign\AltAdminBar\Extend\EntryRepository::class, function ($app) {
            return new \AltDesign\AltAdminBar\Extend\EntryRepository(resolve(Stache::class));
        });
    }
}
