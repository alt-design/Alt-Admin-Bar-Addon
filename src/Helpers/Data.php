<?php
namespace AltDesign\AltAdminBar\Helpers;

use Statamic\Facades\YAML;
use Statamic\Filesystem\Manager;

class Data
{
    public function __construct($type, $onlyRegex = false)
    {
       //
    }

    public static function getMenuConfig() : array
    {
        $currentFile = with(new Manager())->disk()->get( __DIR__ . '/../../resources/menu/menu.yaml');
        return Yaml::parse($currentFile);
    }

}
