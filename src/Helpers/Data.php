<?php

namespace AltDesign\AltAdminBar\Helpers;

use Illuminate\Support\Facades\Session;
use Statamic\Facades\Site;
use Statamic\Filesystem\Manager;
use Statamic\Revisions\RevisionRepository;
use Statamic\Yaml\Yaml;

class Data
{
    /**
     * Session key used to store revisions
     */
    private ?string $revisionKey;

    /**
     * In-memory working copy of the page revision epochs.
     *
     * Structured as a 3-dimensional associative array:
     * [collection][siteHandle][pageId] => epoch (int)
     *
     * Example:
     * [
     *     'blog' => [
     *         'en' => [
     *             'home' => 1714300000,
     *         ],
     *     ],
     * ]
     *
     * @var array<string, array<string, array<string, int>>>|null
     */
    private ?array $revisions;

    public function __construct(
        private Manager $manager,
        private Yaml $yaml
    ) {
        $this->revisionKey = config('alt-admin-bar.revisions.session_key');
        $this->revisions = Session::get($this->revisionKey, []);
    }

    /**
     * Get the menu config as an array from the YAML on disk
     *
     * @throws \Statamic\Yaml\ParseException
     */
    public function getMenuConfig(): array
    {
        $currentFile = $this->manager->disk()->get(__DIR__.'/../../resources/menu/menu.yaml');

        return $this->yaml->parse($currentFile);
    }

    /**
     * Pop the epoch in the working copy and put to session
     */
    public function setRevisionEpoch(
        string $collection,
        string $siteHandle,
        string $pageId,
        ?int $epoch
    ): void {
        unset($this->revisions[$collection][$siteHandle][$pageId]);
        if ($epoch) {
            $this->revisions[$collection][$siteHandle][$pageId] = $epoch;
        }
        $this->putRevisionsToSession();
    }

    /**
     * Get the epoch for the currently active revision.
     *
     * @throws \Exception
     */
    public function getRevisionEpoch(
        string $collection,
        string $pageId,
    ): ?int {
        $siteHandle = self::getSite()->handle() ?? 'default';

        return $this->revisions[$collection][$siteHandle][$pageId] ?? null;
    }

    /**
     * Store the revisions working copy to the session
     */
    public function putRevisionsToSession(): void
    {
        Session::put(
            $this->revisionKey,
            $this->revisions
        );
    }

    /**
     * Get the currently active revision from the revision repository
     *
     * @return mixed|null
     */
    public static function getRevision(
        string $collection,
        string $pageId
    ) {
        $epoch = app(self::class)->getRevisionEpoch(
            collection: $collection,
            pageId: $pageId
        );

        return self::getRevisionRepository(
            collection: $collection,
            pageId: $pageId
        )[$epoch] ?? null;
    }

    /**
     * Get a revision repository for the details on the current site.
     *
     * @throws \Exception
     */
    public static function getRevisionRepository(
        string $collection,
        string $pageId
    ): mixed {
        $siteHandle = self::getSite()->handle() ?? 'default';

        return resolve(RevisionRepository::class)
            ->whereKey(self::makeRevisionsKey(
                collection: $collection,
                siteHandle: $siteHandle,
                pageId: $pageId
            ));
    }

    /**
     * Get the current site
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public static function getSite()
    {
        if (! $site = Site::findByUrl(request()->url())) {
            throw new \Exception('Unable to find site exception');
        }

        return $site;
    }

    /**
     * The revisions repository is accessed with a key
     * that's a file path to the page. build the key and return it.
     */
    public static function makeRevisionsKey(
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
}
