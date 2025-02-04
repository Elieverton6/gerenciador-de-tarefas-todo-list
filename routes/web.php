<?php

use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TarefaController::class, 'index'])->name('home.index');
Route::post('/tarefas/adicionar', [TarefaController::class, 'store'])->name('home.store');
Route::patch('/tarefas/finalizar/{id}', [TarefaController::class, 'finalizar_tarefa'])->name('home.finalizar_tarefa');
Route::patch('/tarefas/desfazer/{id}', [TarefaController::class, 'desfazer_finalizacao'])->name('home.desfazer_finalizacao');
Route::delete('/tarefas/deletar/{id}', [TarefaController::class, 'deletar_tarefa'])->name('home.deletar_tarefa');
