<?php

declare(strict_types=1);

namespace AltDesign\AltAdminBar\Helpers;

use Illuminate\Support\Traits\Macroable;

class RouteGenerator
{
    use Macroable;

    public static function controlPanel()
    {
        return cp_route('dashboard');
    }
}
