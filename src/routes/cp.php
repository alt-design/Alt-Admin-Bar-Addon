<?php

use AltDesign\AltAdminBar\Http\Controllers\AdminBarController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['statamic.cp.authenticated']], function () {
    // Revisions
    Route::get('/alt-design/alt-admin-bar/revisions/set', [
        AdminBarController::class,
        'setRevision',
    ])->name('alt-admin-bar.revision.set');
});
