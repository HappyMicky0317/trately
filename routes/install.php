<?php

use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;

Route::get('/',[InstallController::class,'index']);
Route::get('/step1',[InstallController::class,'step1'])->name('step1');
Route::get('/step2',[InstallController::class,'step2'])->name('step2');
Route::get('/step3',[InstallController::class,'step3'])->name('step3');
Route::get('/step4',[InstallController::class,'step4'])->name('step4');
Route::get('/step5',[InstallController::class,'step5'])->name('step5');
Route::get('/step6',[InstallController::class,'step6'])->name('step6');
Route::post('/db-installation',[InstallController::class,'dbInstallation'])->name('db.installation');
Route::get('/import-sql',[InstallController::class,'importSql'])->name('import.sql');
Route::post('/set-admin-profile',[InstallController::class,'setAdminProfile'])->name('set.admin.profile');
