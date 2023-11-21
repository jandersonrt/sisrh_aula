<?php

use App\Http\Controllers\BeneficioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
Route::get('/funcionarios/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
Route::post('/funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::get('/funcionarios/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

Route::get('/departamentos', [DepartamentoController::class, 'index'])->name('departamentos.index');
Route::get('/departamentos/create', [DepartamentoController::class, 'create'])->name('departamentos.create');
Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamentos.store');
Route::get('/departamentos/{id}/edit', [DepartamentoController::class, 'edit'])->name('departamentos.edit');
Route::put('/departamentos/{id}', [DepartamentoController::class, 'update'])->name('departamentos.update');
Route::delete('/departamentos/{id}', [DepartamentoController::class, 'destroy'])->name('departamentos.destroy');

Route::get('/cargos', [CargoController::class, 'index'])->name('cargos.index');
Route::get('/cargos/create', [CargoController::class, 'create'])->name('cargos.create');
Route::post('/cargos', [CargoController::class, 'store'])->name('cargos.store');
Route::get('/cargos/{id}/edit', [CargoController::class, 'edit'])->name('cargos.edit');
Route::put('/cargos/{id}', [CargoController::class, 'update'])->name('cargos.update');
Route::delete('/cargos/{id}', [CargoController::class, 'destroy'])->name('cargos.destroy');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

Route::get('/beneficios', [BeneficioController::class, 'index'])->name('beneficios.index');
Route::get('/beneficios/create', [BeneficioController::class, 'create'])->name('beneficios.create');
Route::post('/beneficios', [BeneficioController::class, 'store'])->name('beneficios.store');
Route::get('/beneficios/{id}/edit', [BeneficioController::class, 'edit'])->name('beneficios.edit');
Route::put('/beneficios/{id}', [BeneficioController::class, 'update'])->name('beneficios.update');
Route::delete('/beneficios/{id}', [BeneficioController::class, 'destroy'])->name('beneficios.destroy');
