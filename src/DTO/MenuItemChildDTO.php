<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\DTO;

class MenuItemChildDTO
{
    public static function make(
        string $title,
        string $href,
        string $style = 'block px-4 py-2 alt-bg hover:text-alt-grey transition-none hover:shadow-[inset_0px_2px_3px_0px_rgba(0,_0,_0,_0.4)]',
    )
    {
        return new MenuItemChildDTO($title, $href, $style);
    }

    private function __construct(
        public string $title,
        public string $href,
        public string $style,
    )
    {
        //
    }

    public function title() : string
    {
        return $this->title;
    }

    public function href() : string
    {
        return $this->href;
    }
    public function style() : string
    {
        return $this->style;
    }
}
