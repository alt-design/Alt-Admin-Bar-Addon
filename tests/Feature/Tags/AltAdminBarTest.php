<?php

use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertSame;

use App\Models\User;
use AltDesign\AltAdminBar\Tags\AltAdminBar;



it('Returns avatar initial for logged in user', function () {
    actingAs(User::factory->create([
        'name' => 'Joe Bloggs'
    ]));

    $result = (new AltAdminBar(
        Mockery::mock(\Statamic\Auth\UserTags::class),
        Mockery::mock(\Illuminate\Foundation\Vite::class)
    ))->avatar();

    assertSame('J', $result);
});
