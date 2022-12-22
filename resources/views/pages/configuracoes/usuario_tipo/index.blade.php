@extends('dashboard')
@section('title', 'Tipos de Usuário')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Tipos de Usuário
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
        <a href="{{ route('usuario_tipo.adicionar') }}">
            <button class="btn btn-sm btn-danger">Novo Registro</button>
        </a>
    </h3>
</div>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <table class="table table-hover table-striped" id="lista-simples">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th>Tipo de Usuário</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $v)
                        <tr>
                            <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                            <td>{{ $v->titulo }}</td>
                            <td>
                                <a href="{{ url('configuracao/usuario_tipo/editar/'.$v->id) }}">
                                    <button class="badge badge-info"><i class="mdi mdi-pencil"></i> Editar</button>
                                </a>

                                <a href="javascript:void(0)" data-id="{{ $v->id }}" data-tabela="usuarios_niveis">
                                    <button class="badge badge-danger" @if($permite_excluir==0) disabled @endif><i class="mdi mdi-delete"></i> Excluir</button>
                                </a>
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