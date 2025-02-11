<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\DTO;

use AltDesign\AltAdminBar\Helpers\RouteGenerator;

class MenuItemDTO
{
    public ?bool $hasChildren;
    public static function make(
        array $config
    ) : self
    {
        return (new MenuItemDTO(
            title: $config['title'],
            href: $config['href'] ?? '',
            children: $config['children'] ?? []))
            ->applyRouteGenerator($config['routeGenerator'] ?? '');
    }

    private function __construct(
        public string $title,
        public string $href ,
        public array $children,
    )
    {
        $this->hasChildren = ($children != []);
    }

    private function applyRouteGenerator(string $routeGenerator) : self
    {
        if (!$routeGenerator) {
            return $this;
        }

        try {
            $this->href = RouteGenerator::{$routeGenerator}();
        } catch (Exception $exception) {
            throw new Exception("AltAdminBar : Error generating route with generator "
                . $routeGenerator
                .'. Are you sure it exists?');
        }

        return $this;
    }
}
