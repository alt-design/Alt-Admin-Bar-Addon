<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\DTO;

class MenuItemDTO
{
    public ?bool $hasChildren;
    public static function make(
        string $title,
        string $href = '',
        array $children = []
    )
    {
        return new MenuItemDTO($title, $href, $children);
    }

    private function __construct(
        public string $title,
        public string $href ,
        public array $children
    )
    {
        $this->hasChildren = ($children != []);
    }
}
