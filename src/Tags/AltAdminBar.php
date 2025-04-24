<?php

declare(strict_types = 1);

namespace AltDesign\AltAdminBar\Tags;

use AltDesign\AltAdminBar\DTO\MenuItemDTO;
use AltDesign\AltAdminBar\Helpers\Data;
use Illuminate\Foundation\Vite;
use Statamic\Auth\UserTags;
use Statamic\Tags\Tags;

use Exception;

/**
 * Class AltAdminBar
 *
 * @package  AltDesign\AltAdminBar
 * @author   Ben Harvey <ben@alt-design.net>, Benammi Swift <benammi@alt-design.net>, Lucy Ahmed <lucy@alt-design.net>
 * @license  Copyright (C) Alt Design Limited - All Rights Reserved - licensed under the MIT license
 * @link     https://alt-design.net
 */
class AltAdminBar extends Tags
{
    /**
     * @param UserTags $userTags
     * @param Vite $vite
     * @param Data $data
     */
    public function __construct(
        protected UserTags $userTags,
        private Vite $vite,
        private Data $data
    )
    {
    }

    /**
     * Usage: {{ alt_admin_bar }}
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     * @throws Exception
     */
    public function index()
    {
        // Don't even bother if they're not logged in super-users.
        if(!auth()->user() || !auth()->user()->isSuper()) {
            return;
        }

        $menuItems = $this->buildMenuOptions();

        $menuItems = collect(event('alt_admin_menu_items', [$menuItems]))->last();

        if(!is_array($menuItems)) {
            $menuItems = [];
        }

        return view('alt-admin-bar::bar', [
            'adminBarStyles' => $this->styles(),
            'menuItems' => $menuItems,
            'avatar' => auth()->user()->name[0] ?? '', // We have at least the user
            'preferencesUrl' => cp_route('preferences.user.edit'),
            'profileUrl' => cp_route('account')
        ]);
    }

    private function styles() : string
    {
        return sprintf(
            '<link rel="stylesheet" href="%s"/>',
            $this->vite
                ->useHotfile(
                    __DIR__ . '/../../resources/dist/hot'
                )->useBuildDirectory(
                    'vendor/alt-admin-bar/build'
                )->asset(
                    'resources/css/alt-admin-bar.css'
                )
        );
    }

    /**
     * @throws Exception
     * @return array $items
     */
    private function buildMenuOptions() : array
    {
        $items = [];
        $menuConfig = $this->data->getMenuConfig();
        foreach($menuConfig as $menuItem) {
            $children = [];
            foreach($menuItem['children'] ?? [] as $item) {
                $children[] = MenuItemDTO::make($item);
            }

            $dtoData = $menuItem;
            $dtoData['children'] = $children;

            $items[] = MenuItemDTO::make($dtoData);
        }

        return $items;
    }
}
