<?php
namespace AltDesign\AltAdminBar\Helpers;

use Statamic\Yaml\Yaml;
use Statamic\Filesystem\Manager;

class Data
{
    public function __construct(
        private Manager $manager,
        private Yaml $yaml
    )
    {
       //
    }

    public function getMenuConfig() : array
    {
        $currentFile = $this->manager->disk()->get( __DIR__ . '/../../resources/menu/menu.yaml');
        return $this->yaml->parse($currentFile);
    }

}
