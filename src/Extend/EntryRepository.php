<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\Extend;

use Statamic\Contracts\Entries\Entry;
use Statamic\Facades\Site;
use Statamic\Revisions\RevisionRepository;
use Statamic\Stache\Repositories\EntryRepository as BaseEntryRepository;
use AltDesign\AltAdminBar\Helpers\Data;
use Statamic\Support\Arr;

class EntryRepository extends BaseEntryRepository
{
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

        if (!$revision) {
            return $entry->hasStructure()
                ? $entry->structure()->in($site)->find($entry->id())
                : $entry;
        }

        $entryData = $entry->data();
        $revData = $revision->attributes()['data'];
        foreach($entryData as $key => &$value) {
            if (isset($revData[$key])) {
                $entryData[$key] = $revData[$key];
            }
        }
        $entry->data($entryData);


        return $entry;
    }

    public static function makeKey(
        string $collection,
        string $siteHandle,
        string $pageId
    ): string
    {
        return sprintf(
            '%s/%s/%s/%s',
            'collections',
            $collection,
            $siteHandle,
            $pageId
        );
    }
}
