<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Tarefas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Cache::remember('tarefas', 60, function () {
            return Tarefas::all();
        });

        $contagemTarefas = Tarefas::count();
        $tarefasCompletadas = Tarefas::where('completed', 1)->get();

        return view('welcome', [
            'tarefas' => $tarefas,
            'contagemTarefas' => $contagemTarefas,
            'tarefasCompletadas' => $tarefasCompletadas
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'adicionar-tarefa' => 'required|string|max:255',
            ], [
                'adicionar-tarefa.required' => 'Por favor digite alguma mensagem.',
                'adicionar-tarefa.string' => 'O campo deve ser um texto válido.',
                'adicionar-tarefa.max' => 'O campo não pode exceder 255 caracteres.',
            ]);

            $novaTarefa = Tarefas::create([
                'title' => $validated['adicionar-tarefa'],
            ]);

            Alert::success('Sucesso!', 'Tarefa criada com sucesso!');

            $tarefas = Cache::forget('tarefas');
            $tarefas = Cache::remember('tarefas', now()->addMinutes(60), function () {
                return Tarefas::all();
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Ops, deu erro ao criar tarefa!', $e->validator->errors()->first());
        }

        return redirect()->route('home.index');
    }

    public function finalizar_tarefa($id)
    {
        $idsTarefa = Tarefas::find($id);

        if ($idsTarefa) {
            if ($idsTarefa->completed === 1) {
                Alert::error('Erro!', 'Essa tarefa já foi finalizada!');
            } else {
                Tarefas::find($id)->update(['completed' => 1]);
                Alert::success('Sucesso!','A Tarefa foi marcada como finalizada!');

                $tarefas = Cache::forget('tarefas');
                $tarefas = Cache::remember('tarefas', now()->addMinutes(60), function () {
                    return Tarefas::all();
                });
            }
        } else {
            Alert::error('Erro!', 'Ops, deu erro ao finalizar tarefa');
        }

        return redirect()->route('home.index');
    }

    public function desfazer_finalizacao($id)
    {
        $tarefa = Tarefas::find($id);

        if ($tarefa) {
            if ($tarefa->completed == 1) {
                $tarefa->update(['completed' => 0]);

                $tarefas = Cache::forget('tarefas');
                $tarefas = Cache::remember('tarefas', now()->addMinutes(60), function () {
                    return Tarefas::all();
                });
                Alert::success('Sucesso!', 'A finalização da tarefa foi revertida!');
            } else {
                Alert::error('Erro!', 'Ops, a tarefa não está finalizada!');
            }
        }

        return redirect()->route('home.index');
    }

    public function deletar_tarefa($id)
    {
        $tarefa = Tarefas::find($id);

        if ($tarefa) {
            $tarefa->delete();
            Alert::success('Sucesso!', 'Tarefa excluida com sucesso!');

            $tarefas = Cache::forget('tarefas');
            $tarefas = Cache::remember('tarefas', now()->addMinutes(60), function () {
                return Tarefas::all();
            });
        } else {
            Alert::error('Erro!', 'Ops, deu erro ao excluir tarefa');
        }

        return redirect()->route('home.index');
    }
}
