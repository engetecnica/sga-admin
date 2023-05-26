@extends('dashboard')
@section('title', 'Ativos Externos')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Funções
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Funções <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            <a href="{{ route('cadastro.funcionario.funcoes.adicionar') }}">
                <button class="btn btn-sm btn-danger">Cadastrar</button>
            </a>
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <table class="table-hover table-striped table">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>Código</th>
                                <th>Função</th>
                                <th>Qtd Funcionários</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($funcoes as $funcao)
                                <tr>
                                    <td class="text-center align-middle"><span class="badge badge-dark">{{ $funcao->id }}</span></td>
                                    <td class="align-middle">{{ $funcao->codigo }}</td>
                                    <td class="align-middle">{{ $funcao->funcao }}</td>
                                    <td class="align-middle">{{ count($funcao->funcionario) }}</td>
                                    <td class="d-flex gap-2 align-middle">
                                        <a class="badge badge-success" href="{{ route('cadastro.funcionario.funcoes.editar', $funcao->id) }}">Editar</a>

                                        <form action="{{ route('cadastro.funcionario.funcoes.destroy', $funcao->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir">
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
