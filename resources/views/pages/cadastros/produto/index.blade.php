@extends('dashboard')
@section('title', 'Produtos')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Produtos
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
        <a href="{{ route('cadastro.produto.adicionar') }}">
            <button class="btn btn-sm btn-danger">Novo Registro</button>
        </a>

        <a href="{{ route('cadastro.produto.associar.adicionar') }}">
            <button class="btn btn-sm btn-info">Associar Líder/Empresa</button>
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
                            <th>Título do Produto</th>
                            <th>Empresa / Líder</th>
                            <th>Status</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $v)
                        <tr>
                            <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                            <td>{{ $v->titulo }}</td>
                            <td>
                                @if(count($v->associados) >0)

                                <button class="badge badge-danger consultar-produto-associado" data-id_produto="{{ $v->id }}" data-bs-toggle="modal" data-bs-target="#consultar-produto-associado">
                                    Consultar Associados ({{ count($v->associados) }})
                                </button>
                                @else
                                <button class="badge badge-warning">Nenhuma empresa/líder associada</button>
                                @endif
                            </td>
                            <td>{{ $v->status }} </td>
                            <td>
                                <a href="{{ url('cadastro/produto/editar/'.$v->id) }}">
                                    <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar</button>
                                </a>

                                <a href="javascript:void(0)" class="excluir-padrao" data-id="{{ $v->id }}" data-table="produtos" data-module="cadastro/produto" data-redirect="{{ route('produto') }}">
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

<!-- The Modal -->
<div class="modal fade" id="consultar-produto-associado">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Líder/Empresa Associado ao Produto (NOME)</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


@endsection