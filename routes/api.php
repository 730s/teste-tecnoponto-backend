<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;

Route::get('/personagens', [CharacterController::class, 'index']);

Route::get('/auditoria', [AuditController::class, 'index']);
