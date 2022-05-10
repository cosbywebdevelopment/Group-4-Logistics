<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::get('dashboard/frontend', [DashboardController::class, 'frontend'])
    ->name('dashboard.frontend')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard.frontend'));
    });

Route::patch('dashboard/frontend/update/{id}', [DashboardController::class, 'update'])
    ->name('dashboard.frontend.update')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard.frontend.update'));
    });

Route::delete('dashboard/frontend/deleteOrder/{id}', [DashboardController::class, 'deleteOrder'])
    ->name('dashboard.frontend.deleteOrder')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard.frontend.deleteOrder'));
    });
