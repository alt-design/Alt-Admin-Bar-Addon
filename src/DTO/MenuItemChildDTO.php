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
            style:  $config['style'] ?? 'block px-4 py-2 alt-bg hover:text-alt-grey transition-none hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]',
            post:   $config['post'] ?? false
        );
    }

    private function __construct(
        public string $title,
        public string $href,
        public string $style,
        public bool $post,
    )
    {
        //
    }
}
