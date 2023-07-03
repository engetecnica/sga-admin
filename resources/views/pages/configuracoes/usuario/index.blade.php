@extends('dashboard')
@section('title', 'Usuários')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary me-2 text-white">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Usuários
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Configurações <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('usuario.adicionar') }}">
            <button class="btn btn-sm btn-danger">Novo Registro</button>
        </a>
    </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <table class="table-hover table-striped table" id="lista-simples">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th>Tipo de Usuário</th>
                            @if (Session::get('usuario_vinculo')['id_nivel'] == 2)
                            <th>Funcionário</th>
                            <th>Obra</th>
                            @endif
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista as $v)
                        <tr>
                            <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                            <td>{{ $v->nivel }}</td>
                            @if (Session::get('usuario_vinculo')['id_nivel'] == 2)
                            <td>{{ $v->vinculo->vinculo_funcionario->nome ?? '-' }}</td>
                            <td><span class="badge badge-danger">{{ $v->vinculo->vinculo_obra->codigo_obra ?? '-' }}</span></td>
                            @endif
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->email }}</td>
                            <td class="d-flex justify-itens-between">

                                @if (session()->get('usuario_vinculo')->id_nivel <= 2) <a href="{{ route('usuario.editar', $v->id) }}">
                                    <button class="badge badge-info mr-2"><i class="mdi mdi-pencil"></i> Editar</button>
                                    </a>
                                    @endif

                                    <!-- @if (session()->get('usuario_vinculo')->id_nivel <= 2) <form action="{{ route('usuario.destroy', $v->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                            <i class="mdi mdi-delete"></i> Excluir
                                        </button>
                                        </form>
                                        @endif -->

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection