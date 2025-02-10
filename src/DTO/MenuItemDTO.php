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

    public function hasChildren() : bool
    {
        return $this->hasChildren;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function href() : string
    {
        return $this->href;
    }

    public function children() : array
    {
        return $this->children;
    }
}
