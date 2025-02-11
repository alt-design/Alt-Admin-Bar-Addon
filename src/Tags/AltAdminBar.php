<?php

declare(strict_types = 1);

namespace AltDesign\AltAdminBar\Tags;

use AltDesign\AltAdminBar\DTO\MenuItemChildDTO;
use AltDesign\AltAdminBar\DTO\MenuItemDTO;
use AltDesign\AltAdminBar\Helpers\Data;
use AltDesign\AltAdminBar\Helpers\RouteGenerator;
use Illuminate\Foundation\Vite;
use Statamic\Auth\UserTags;
use Statamic\Tags\Tags;

use Exception;

class AltAdminBar extends Tags
{
    protected static $handle = 'AltAdminBar';
    protected $assetPathProd = '/vendor/alt-design/alt-admin-bar/resources/img/';

    public function __construct(
        protected UserTags $userTags
    )
    {
    }

    private function logo()
    {
        return 'https://statamic.com/images/storage/avatars/DFISl4Clu4Bk6uqdzekv2nThnGVsJdSKr4GfERSZ.jpg?fit=max&w=300&h=300';
//        return $this->assetPathProd . 'alt-logo.jpg';
    }

    public function editUrl()
    {
//        return cp_route('collections.entries.edit', ['collection' => 'pages', 'entry' => $this->params->get('id')]);
    }

    private function profileUrl()
    {
        return cp_route('account');
    }

    private function avatar()
    {
        return strtoupper(substr(auth()?->user()?->name() ?? '', 0,1));
    }

    public function logoutUrl()
    {
        return cp_route('logout');
    }

    public function index()
    {
        return view('alt-admin-bar::bar', [
            'adminBarStyles' => $this->styles(),
            'menuItems' => $this->buildMenuOptions(),
            'logo' =>  $this->logo(),
            'profileUrl' => $this->profileUrl(),
            'avatar' => $this->avatar(),
            'cp' => RouteGenerator::controlPanel(),
            'logout' => $this->logoutUrl()
        ]);
    }

    private function styles() : string
    {
        $vite = (new Vite)->useHotfile( __DIR__ . '/../../resources/dist/hot')->useBuildDirectory('vendor/alt-admin-bar/build');
        $assets = sprintf('<link rel="stylesheet" href="%s"/>', $vite->asset('resources/css/alt-admin-bar.css'));
        return $assets;
    }

    /**
     * @throws Exception
     * @return array $items
     */
    private function buildMenuOptions() : array
    {
        $items = [];
        $menuConfig = Data::getMenuConfig();
        foreach($menuConfig as $menuItem) {
            $children = [];
            foreach($menuItem['children'] ?? [] as $item) {
                $children[] = MenuItemChildDTO::make($item);
            }

            $dtoData = $menuItem;
            $dtoData['children'] = $children;

            $items[] = MenuItemDTO::make($dtoData);
        }
        return $items;
    }

    private function buildCacheMenu(array &$items) : void
    {
        $cacheConfig = Data::getMenuConfig()['cache'];
        $children = [];
        foreach($cacheConfig['children'] ?? [] as $item) {
            $children[] = MenuItemChildDTO::make(...$item);
        }

        $dtoData = $cacheConfig;
        $dtoData['children'] = $children;

        $items[] = MenuItemDTO::make(...$dtoData);
    }
}
