<?php
namespace AltDesign\AltAdminBar\Helpers;

use Illuminate\Support\Facades\Session;
use Statamic\Facades\Site;
use Statamic\Yaml\Yaml;
use Statamic\Filesystem\Manager;
use Statamic\Revisions\RevisionRepository;

class Data
{
    /**
     * Session key used to store revisions
     *
     * @var string|null
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

    /**
     * @param Manager $manager
     * @param Yaml $yaml
     */
    public function __construct(
        private Manager $manager,
        private Yaml $yaml
    )
    {
        $this->revisionKey = config('alt-admin-bar.revisions.session_key');
        $this->revisions = Session::get($this->revisionKey, []);
    }

    /**
     * Get the menu config as an array from the YAML on disk
     *
     * @return array
     * @throws \Statamic\Yaml\ParseException
     */
    public function getMenuConfig() : array
    {
        $currentFile = $this->manager->disk()->get( __DIR__ . '/../../resources/menu/menu.yaml');
        return $this->yaml->parse($currentFile);
    }

    /**
     * Pop the epoch in the working copy and put to session
     *
     * @param string $collection
     * @param string $siteHandle
     * @param string $pageId
     * @param int $epoch
     * @return void
     */
    public function setRevisionEpoch(
        string $collection,
        string $siteHandle,
        string $pageId,
        int $epoch
    ): void
    {
        $this->revisions[$collection][$siteHandle][$pageId] = $epoch;
        $this->putRevisionsToSession();
    }

    /**
     * Get the epoch for the currently active revision.
     *
     * @param string $collection
     * @param string $pageId
     * @return int|null
     * @throws \Exception
     */
    public function getRevisionEpoch(
        string $collection,
        string $pageId,
    ): ?int
    {
        $siteHandle = self::getSite()->handle() ?? 'default';
        return $this->revisions[$collection][$siteHandle][$pageId] ?? null;
    }

    /**
     * Store the revisions working copy to the session
     *
     * @return void
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
     * @param string $collection
     * @param string $pageId
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
     * @param string $collection
     * @param string $pageId
     * @return mixed
     * @throws \Exception
     */
    public static function getRevisionRepository(
        string $collection,
        string $pageId
    ): mixed
    {
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
     *
     * @param string $collection
     * @param string $siteHandle
     * @param string $pageId
     * @return string
     */
    public static function makeRevisionsKey(
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
