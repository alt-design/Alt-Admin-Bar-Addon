<?php namespace AltDesign\AltAdminBar\Tags;

use Illuminate\Foundation\Vite;
use Statamic\Tags\Tags;

class AltAdminBar extends Tags
{
    protected static $handle = 'AltAdminBar';
    protected $assetPathProd = '/vendor/alt-design/alt-admin-bar/resources/img/';

    public function init()
    {
        return view('alt-admin-bar::bar');
    }

    public function defaultCSS()
    {
        $vite = (new Vite)->useHotfile( __DIR__ . '/../../resources/dist/hot')->useBuildDirectory('vendor/alt-admin-bar/build');
        $assets = sprintf('<link rel="stylesheet" href="%s"/>', $vite->asset('resources/css/alt-admin-bar.css'));
        return $assets;
    }

    public function logo()
    {
        return 'https://statamic.com/images/storage/avatars/DFISl4Clu4Bk6uqdzekv2nThnGVsJdSKr4GfERSZ.jpg?fit=max&w=300&h=300';
//        return $this->assetPathProd . 'alt-logo.jpg';
    }

    public function editUrl()
    {
//        return cp_route('collections.entries.edit', ['collection' => 'pages', 'entry' => $this->params->get('id')]);
    }

    public function profileUrl()
    {
        return cp_route('account');
    }

    public function avatar()
    {
        return strtoupper(substr(auth()->user()->name(), 0,1));
    }

    public function logoutUrl()
    {
        return cp_route('logout');
    }
}
