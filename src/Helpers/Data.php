<?php
namespace AltDesign\AltAdminBar\Helpers;

use Illuminate\Support\Facades\Session;
use Statamic\Facades\Site;
use Statamic\Yaml\Yaml;
use Statamic\Filesystem\Manager;
use Statamic\Revisions\RevisionRepository;

class Data
{
    private ?string $revisionKey;
    private ?array $revisions;

    public function __construct(
        private Manager $manager,
        private Yaml $yaml
    )
    {
        $this->revisionKey = config('alt-admin-bar.revisions.session_key');
        $this->revisions = Session::get($this->revisionKey, []);
    }

    public function getMenuConfig() : array
    {
        $currentFile = $this->manager->disk()->get( __DIR__ . '/../../resources/menu/menu.yaml');
        return $this->yaml->parse($currentFile);
    }

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

    public function getRevisionEpoch(
        string $collection,
        string $pageId,
    ): ?int
    {
        $siteHandle = self::getSite()->handle() ?? 'default';
        return $this->revisions[$collection][$siteHandle][$pageId] ?? null;
    }

    public function putRevisionsToSession(): void
    {
        Session::put(
            $this->revisionKey,
            $this->revisions
        );
    }

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

    public static function getRevisionRepository(
        string $collection,
        string $pageId
    ) {
        $siteHandle = self::getSite()->handle() ?? 'default';

        return resolve(RevisionRepository::class)
            ->whereKey(self::makeRevisionsKey(
                collection: $collection,
                siteHandle: $siteHandle,
                pageId: $pageId
            ));
    }

    public static function getSite()
    {
        if (! $site = Site::findByUrl(request()->url())) {
            throw new \Exception('Unable to find site exception');
        }
        return $site;
    }


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
