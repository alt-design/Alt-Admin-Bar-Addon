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
            children: $config['children'] ?? [],
            route_args: $config['route_args'] ?? [],
            post: $config['post'] ?? false,
            cp_route: $config['cp_route'] ?? false
        ))
            ->mutateRoutes();
    }

    private function __construct(
        public string $title,
        public string $href ,
        public array $children,
        public array $route_args,
        public bool $post,
        public bool $cp_route
    )
    {
        $this->hasChildren = ($children != []);
    }

    private function mutateRoutes() : self
    {
        // If we have a post req, let's amend the href
        if($this->post) {
            $this->href = cp_route($this->href, $this->route_args);

            return $this; // Don't think we need to do anything else here?
        }

        return $this;
    }
}
