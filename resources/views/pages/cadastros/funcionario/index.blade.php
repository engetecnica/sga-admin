@extends('dashboard')
@section('title', 'Funcionários')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Funcionários
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Cadastros <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            <a href="{{ route('cadastro.funcionario.adicionar') }}">
                <button class="btn btn-sm btn-danger">Novo Registro</button>
            </a>
            <a href="{{ route('cadastro.funcionario.funcoes.index') }}">
                <button class="btn btn-sm btn-primary">Cadastrar Funções</button>
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
                                <th>Obra</th>
                                <th>Matrícula</th>
                                <th>Nome Completo</th>
                                <th>WhatsApp</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista as $v)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                                    <td><span class="badge badge-danger">{{ $v->codigo_obra }}</span></td>
                                    <td>{{ $v->matricula ?? '-' }}</td>
                                    <td>{{ $v->nome }}</td>
                                    <td>{{ $v->celular }}</td>
                                    <td>{{ $v->email }}</td>
                                    <td>{{ $v->status }} </td>
                                    <td class="d-flex justify-itens-between">

                                        <a class="badge badge-info mr-2" href="{{ route('cadastro.funcionario.editar', $v->id) }}">
                                            <i class="mdi mdi-pencil"></i> Editar
                                        </a>

                                        <form action="{{ route('cadastro.funcionario.destroy', $v->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                                <i class="mdi mdi-delete"></i> Excluir
                                            </button>
                                        </form>
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
