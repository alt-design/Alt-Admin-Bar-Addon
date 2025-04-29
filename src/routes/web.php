<?php
use Illuminate\Support\Facades\Route;
use AltDesign\AltAdminBar\Http\Controllers\AdminBarController;

Route::group(['middleware' => ['web']], function() {
    // Revisions
    Route::get('/alt-design/alt-admin-bar/revisions/set', [
        AdminBarController::class,
        'setRevision'
    ])->name('alt-admin-bar.revision.set');
});
