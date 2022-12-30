@extends('dashboard')
@section('title', 'Usuários')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
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

                <table class="table table-hover table-striped" id="lista-simples">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th>Tipo de Usuário</th>
                            <th>Empresa</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $v)
                        <tr>
                            <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                            <td>{{ $v->nivel }}</td>
                            <td>Nome da Empresa</td>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->email }}</td>
                            <td>
                                @if($v->id != Auth::user()->id)
                                <a href="{{ route('usuario.editar', $v->id) }}">
                                    <button class="badge badge-info"><i class="mdi mdi-pencil"></i> Editar</button>
                                </a>

                                <a 
                                    href="javascript:void(0)" 
                                    class="excluir-padrao" 
                                    data-id="{{ $v->id }}" 
                                    data-table="users" 
                                    data-module="configuracao/usuario" 
                                    data-redirect="{{ route('usuario') }}"
                                >
                                    <button class="badge badge-danger"><i class="mdi mdi-delete"></i> Excluir</button>
                                </a>
                                @endif
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