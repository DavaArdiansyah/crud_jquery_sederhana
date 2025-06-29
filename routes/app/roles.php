<?php

use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

Route::get('roles/datatables', [RolesController::class, 'datatables'])->name('pengaturan.roles.datatables');
Route::resource('roles', RolesController::class)
->name('index', 'pengaturan.roles.index')
->name('edit', 'pengaturan.roles.edit')
->name('show', 'pengaturan.roles.show')
->name('store', 'pengaturan.roles.store')
->name('update', 'pengaturan.roles.update')
->name('destroy', 'pengaturan.roles.destroy');
