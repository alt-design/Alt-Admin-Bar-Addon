<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\DTO;

class MenuItemChildDTO
{
    public static function make(
        array $config
    ) : self
    {
        return new MenuItemChildDTO(
            title:  $config['title'],
            href:   $config['href'],
            post:   $config['post'] ?? false
        );
    }

    private function __construct(
        public string $title,
        public string $href,
        public bool $post,
    )
    {
        //
    }
}
