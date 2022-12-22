@extends('dashboard')
@section('title', 'Empresas')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Empresas / Líderes
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
        <a href="{{ route('cadastro.empresa.adicionar') }}">
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
                            <th>CNPJ/CPF</th>
                            <th>Nome / Razão Social</th>
                            <th>WhatsApp</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $v)
                        <tr>
                            <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                            <td>{{ ($v->cpf) ?? '-' }}</td>
                            <td>{{ $v->nome }}</td>
                            <td>{{ $v->celular }}</td>
                            <td>{{ $v->email }}</td>
                            <td>{{ $v->status }} </td>
                            <td>
                                <a href="{{ url('cadastro/empresa/editar/'.$v->id) }}">
                                    <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar</button>
                                </a>

                                <a 
                                    href="javascript:void(0)" 
                                    class="excluir-padrao" 
                                    data-id="{{ $v->id }}" 
                                    data-table="empresas" 
                                    data-module="cadastro/empresa" 
                                    data-redirect="{{ route('empresa') }}"
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