<?php

use AltDesign\AltAdminBar\Helpers\Data;
use Statamic\Filesystem\Manager;

it('Returns an array when YAML is loaded from the disk', function () {
    $yaml = <<<'YAML'
        title: Example Post
        slug: example-post
        author: john_doe
        tags:
          - statamic
          - pestphp
          - testing
        published: true
        date: 2025-04-12
        meta:
          description: This is a mock post for testing purposes.
          keywords:
            - mock
            - yaml
            - test
        YAML;

    $manager = Mockery::mock(Manager::class);
    $manager
        ->shouldReceive('disk')
        ->andReturnSelf();

    $manager->shouldReceive('get')
        ->andReturn($yaml);

    $data = new Data(
        manager: $manager,
        yaml: app(Statamic\Yaml\Yaml::class)
    );

    $result = $data->getMenuConfig(); // assuming this reads the YAML and parses it

    dd($result);

});
