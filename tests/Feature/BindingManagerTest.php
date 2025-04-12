<?php

use AltDesign\AltAdminBar\BindingManager;
use AltDesign\AltAdminBar\Helpers\Data;

it('Binds the Data class to the service container', function () {
    // Set up a fresh app instance if necessary
    $app = app();

    // Instantiate and run your binding manager
    $bindingManager = new BindingManager(
        app: $app
    );
    $bindingManager->register();

    // Now assert that your bindings exist
    expect($app->bound(Data::class))->toBeTrue();
});

it('Service container return instanceof Data class', function () {
    // Set up a fresh app instance if necessary
    $app = app();

    // Instantiate and run your binding manager
    $bindingManager = new BindingManager(
        app: $app
    );
    $bindingManager->register();

    $instance = $app->make(Data::class);
    expect($instance)->toBeInstanceOf(Data::class);
});
