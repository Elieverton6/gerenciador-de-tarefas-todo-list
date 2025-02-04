<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tarefas;

class TarefaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function um_usuario_pode_criar_uma_tarefa()
    {
        $this->post(route('home.store'), [
            'adicionar-tarefa' => 'Minha primeira tarefa'
        ])->assertRedirect(route('home.index'));

        $this->assertDatabaseHas('tarefas', [
            'title' => 'Minha primeira tarefa'
        ]);
    }

    /** @test */
    public function um_usuario_pode_finalizar_uma_tarefa()
    {
        $tarefa = Tarefas::create(['title' => 'Tarefa a ser finalizada']);

        $this->patch(route('home.finalizar_tarefa', $tarefa->id))
            ->assertRedirect(route('home.index'));

        $this->assertDatabaseHas('tarefas', [
            'id' => $tarefa->id,
            'completed' => 1
        ]);
    }

    /** @test */
    public function um_usuario_nao_pode_finalizar_tarefa_que_ja_esta_finalizada()
    {
        $tarefa = Tarefas::create(['title' => 'Tarefa já finalizada', 'completed' => 1]);

        $this->patch(route('home.finalizar_tarefa', $tarefa->id))
            ->assertStatus(302);
    }

    /** @test */
    public function um_usuario_pode_desfazer_a_finalizacao_de_uma_tarefa()
    {
        $tarefa = Tarefas::create(['title' => 'Tarefa a ser revertida', 'completed' => 1]);

        $this->patch(route('home.desfazer_finalizacao', $tarefa->id))
            ->assertRedirect(route('home.index'));

        $this->assertDatabaseHas('tarefas', [
            'id' => $tarefa->id,
            'completed' => 0
        ]);
    }

    /** @test */
    public function um_usuario_nao_pode_desfazer_a_finalizacao_de_uma_tarefa_que_nao_esta_finalizada()
    {
        $tarefa = Tarefas::create(['title' => 'Tarefa não finalizada', 'completed' => 0]);

        $this->patch(route('home.desfazer_finalizacao', $tarefa->id))
            ->assertStatus(302);
    }

    /** @test */
    public function um_usuario_pode_deletar_uma_tarefa()
    {
        $tarefa = Tarefas::create(['title' => 'Tarefa a ser deletada']);

        $this->delete(route('home.deletar_tarefa', $tarefa->id))
            ->assertRedirect(route('home.index'));

        $this->assertDatabaseMissing('tarefas', [
            'id' => $tarefa->id
        ]);
    }

    /** @test */
    public function um_usuario_nao_pode_deletar_uma_tarefa_que_nao_existe()
    {
        $tarefaIdInexistente = 999;

        $this->delete(route('home.deletar_tarefa', $tarefaIdInexistente))
            ->assertStatus(302);
    }

    /** @test */
    public function um_usuario_nao_pode_criar_uma_tarefa_com_dados_invalidos()
    {
        $this->post(route('home.store'), [
            'adicionar-tarefa' => ''
        ])->assertStatus(302);

        $this->post(route('home.store'), [
            'adicionar-tarefa' => str_repeat('a', 256)
        ])->assertStatus(302);
    }
}
