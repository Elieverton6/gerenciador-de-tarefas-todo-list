@extends('layouts.app')
@section('title', 'Todo List - Home')
@section('outros-links')
    <!-- CSS -->
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/footer.css">
    <link rel="stylesheet" href="src/css/mediaqueries.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- FONTS AWESOME -->
    <script src="https://kit.fontawesome.com/18a975bbae.js" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="src/js/script.js"></script>
@endsection
@section('main')
    @include('sweetalert::alert')
    <div class="wrapper">
        <div class="logo">
            <img src="src/img/logo.png" alt="Logo TODO">
        </div>

        <div class="form-container">
            <form action="{{ route('home.store') }}" method="POST">
                @csrf
                <div class="input-tarefa">
                    <input type="text" name="adicionar-tarefa" placeholder="Adicione uma nova tarefa" value="{{ old('adicionar-tarefa' )}}" maxlength="255">
                    <button class="button-icon" type="submit">Criar <img src="src/img/icon-add.png" alt="Add"></button>
                </div>
            </form>
        </div>

        <div class="tarefas-container">
            <div class="texto-tarefas-criada-concluidas-container">
                <div class="texto-tarefas-criada">
                    <p>Tarefas criadas <span>{{ $contagemTarefas }}</span></p>
                </div>
                <div class="texto-tarefas-concluidas">
                    <p>Concluidas <span>{{ count($tarefasCompletadas) }} de {{ $contagemTarefas }}</span></p>
                </div>
            </div>
            <div class="tarefas-criadas-wrapper">
                @foreach ($tarefas as $tarefa)
                <div class="tarefas-criadas-box">
                    <div class="tarefas-status-date">
                        <div class="tarefas-status">
                            <h2 class="@if ($tarefa->completed == 1) finalizado @endif">
                                {!!
                                    $tarefa->completed == 1 ? 'Tarefa Finalizada <i class="fa-solid fa-check-double"></i>' : 'Em Andamento <i class="fas fa-spinner fa-spin"></i>'
                                !!}
                            </h2>
                        </div>
                        <div class="tarefas-date-hour">
                            <p>
                                {{ $tarefa->created_at->format('d/m/Y H:i:s'); }}
                            </p>
                        </div>
                    </div>
                    <div class="tarefa-title">
                        <h1>{{ $tarefa->title }}</h1>
                    </div>
                    <div class="hr"></div>
                    <div class="tarefa-atualizar-deletar-wrapper">
                        @if ($tarefa->completed != 1)
                        <form class="form-finalizar-tarefa" action="{{ route('home.finalizar_tarefa', ['id' => $tarefa->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Finalizar Tarefa <i class="fa-solid fa-check-double"></i></button>
                        </form>
                        @endif
                        @if ($tarefa->completed == 1)
                        <form class="form-desfazer-finalizacao" action="{{ route('home.desfazer_finalizacao', ['id' => $tarefa->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button>Desfazer Finalização <i class="fa-solid fa-undo"></i></button>
                        </form>
                        @endif
                        <form class="form-deletar-tarefa" action="{{ route('home.deletar_tarefa', ['id' => $tarefa->id]) }}" method="POST" id="form-delete-{{ $tarefa->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $tarefa->id }})">
                                Deletar Tarefa <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                @if (!$tarefas->isNotEmpty())
                    <div class="sem-tarefas-text">
                        <p>Não tem tarefas criadas!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
