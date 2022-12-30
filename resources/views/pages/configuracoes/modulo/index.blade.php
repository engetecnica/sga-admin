@extends('dashboard')
@section('title', 'Módulos')
@section('content')


<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Módulos
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
        <a href="{{ route('modulo.adicionar') }}">
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
                            <th>Módulo</th>
                            <th>Título</th>
                            <th>URL</th>
                            <th>Ações Permitidas</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $v)


                            @php

                                $btn = array();
                                $btn[] = (isset($v->tipo_de_acao) && str_contains($v->tipo_de_acao, 'view')) 
                                    ? '<span class="badge badge-danger badge-margin"><i class="mdi mdi-eye" title="Visualizar" data-toggle="tooltip" data-placement="top"></i></span>' : false;

                                $btn[] = (isset($v->tipo_de_acao) && str_contains($v->tipo_de_acao, 'add')) 
                                    ? '<span class="badge badge-primary badge-margin"><i class="mdi mdi-plus" title="Adicionar" data-toggle="tooltip" data-placement="top"></i></span>' : false;

                                $btn[] = (isset($v->tipo_de_acao) && str_contains($v->tipo_de_acao, 'edit')) 
                                    ? '<span class="badge badge-success badge-margin"><i class="mdi mdi-pencil" title="Editar" data-toggle="tooltip" data-placement="top"></i></span>' : false;

                                $btn[] = (isset($v->tipo_de_acao) && str_contains($v->tipo_de_acao, 'delete')) 
                                    ? '<span class="badge badge-info badge-margin"><i class="mdi mdi-delete" title="Excluir" data-toggle="tooltip" data-placement="top"></i></span>' : false;

                                $btn[] = (isset($v->tipo_de_acao) && str_contains($v->tipo_de_acao, 'other')) 
                                    ? '<span class="badge badge-warning badge-margin"><i class="mdi mdi-all-inclusive" title="Outros" data-toggle="tooltip" data-placement="top"></i></span>' : false;

                            @endphp


                        <tr>
                            <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                            <td>{{ ($v->vinculo) ?? '-' }}</td>
                            <td>{{ $v->titulo }}</td>
                            <td>{{ $v->url_amigavel }}</td>
                            <td>
                                @php 
                                    if($btn){
                                        foreach($btn as $button){
                                            echo  $button;
                                        }
                                    }                                      
                                @endphp
                            </td>
                            <td>
                                <a href="{{ route('modulo.editar', $v->id) }}">
                                    <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar</button>
                                </a>

                                <a 
                                    href="javascript:void(0)" 
                                    class="excluir-padrao" 
                                    data-id="{{ $v->id }}" 
                                    data-table="users" 
                                    data-module="configuracao/modulo" 
                                    data-redirect="{{ route('modulo') }}"
                                >
                                    <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="mdi mdi-delete"></i> Excluir</button>
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