<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\Decorators;

use AltDesign\AltAdminBar\Helpers\Data;
use Statamic\Contracts\Entries\Entry;
use Statamic\Contracts\Entries\EntryRepository as EntryRepositoryContract;
use Statamic\Facades\Blink;
use Statamic\Stache\Stache;
use Statamic\Support\Arr;

class EntryRepositoryDecorator
{
    protected array $substitutionsByUri = [];
    protected array $substitutionsById = [];

    public function __construct(
        protected EntryRepositoryContract $base,
        protected Stache $stache
    ) {
        //
    }

    public function findByUri(string $uri, ?string $site = null): ?Entry
    {
        $site = $site ?? $this->stache->sites()->first();

        if ($substitute = Arr::get($this->substitutionsByUri, $site.'@'.$uri)) {
            return $substitute;
        }

        $entry = $this->query()
            ->where('uri', $uri)
            ->where('site', $site)
            ->first();

        if (! $entry) {
            return null;
        }

        if ($entry->uri() !== $uri) {
            return null;
        }

        // Hook data here.
        $revision = app(Data::class)->getRevision(
            $entry->collection->handle,
            $entry->id
        );

        if (! $revision || !config('statamic.revisions.enabled')) {
            return $entry->hasStructure()
                ? $entry->structure()->in($site)->find($entry->id())
                : $entry;
        }

        $entryData = $entry->data();
        $revData = $revision->attributes()['data'];
        foreach ($entryData as $key => &$value) {
            if (isset($revData[$key])) {
                $entryData[$key] = $revData[$key];
            }
        }
        $entry->data($entryData);

        return $entry;
    }

    public function substitute($item)
    {
        Blink::store('entry-uris')->forget($item->id());
        $this->substitutionsById[$item->id()] = $item;
        $this->substitutionsByUri[$item->locale().'@'.$item->uri()] = $item;
    }

    public function applySubstitutions($items)
    {
        return $items->map(function ($item) {
            return $this->substitutionsById[$item->id()] ?? $item;
        });
    }

    public static function makeKey(
        string $collection,
        string $siteHandle,
        string $pageId
    ): string {
        return sprintf(
            '%s/%s/%s/%s',
            'collections',
            $collection,
            $siteHandle,
            $pageId
        );
    }

    // Delegate all other methods to the base
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}
