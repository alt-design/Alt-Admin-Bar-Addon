<?php

use AltDesign\AltAdminBar\Tags\AltAdminBar;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertSame;

it('Returns avatar initial for logged in user', function () {
    actingAs(User::factory->create([
        'name' => 'Joe Bloggs',
    ]));

    $result = (new AltAdminBar(
        Mockery::mock(\Statamic\Auth\UserTags::class),
        Mockery::mock(\Illuminate\Foundation\Vite::class)
    ))->avatar();

    assertSame('J', $result);
});
