@extends('dashboard')
@section('title', 'Requisições')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Requisição
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Requisição <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops!</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @php
                $action = isset($store) ? route('ferramental.requisicao.update', $store->id) : route('ferramental.requisicao.store');
                @endphp
                <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf


                    <div class="row mt-3">
                        <div class="col-6">
                            @include('components.fields.id_obra', ['title' => 'Obra Origem', 'field' => 'id_obra_origem'])
                        </div>

                        <div class="col-6">
                            @include('components.fields.id_obra', ['title' => 'Obra Destino', 'field' => 'id_obra_destino'])
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-9">
                            <label id="id_ativo_externo">Pesquisar Item</label>
                            <select name="id_ativo_externo[]" id="id_ativo_externo" class="form-control select2 listar-ativos">
                                <option>Pesquise o Item desejado</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <label id="quantidade">Quantidade</label>
                            <input type="number" value="" name="quantidade[]" class="form-control text_quantidade" disabled>
                        </div>
                        <div class="col-2">
                            <label id="botoes">Ações</label>
                            <div id="botoes">
                                <button type="button" class="btn btn-warning listar-ativos-adicionar"><i class="mdi mdi-plus"></i></button>
                                <button type="button" class="btn btn-primary listar-ativos-remover"><i class="mdi mdi-minus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div id="listar-ativos-linha"></div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <label id="observacoes">Observações</label>
                            <textarea class="form-control" id="observacoes" name="observacoes" rows="4"></textarea>
                        </div>
                    </div>




                    <div class="row">

                        <div class="col-10 mt-3">
                            <button type="submit" class="btn btn-gradient-primary font-weight-medium">Salvar</button>

                            <a href="{{ route('ferramental.requisicao') }}">
                                <button type="button" class="btn btn-gradient-danger font-weight-medium">Cancelar</button>
                            </a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<template id="listar-ativos-template">
    <div class="row mt-3">
        <div class="col-9">
            <select name="id_ativo_externo[]" id="id_ativo_externo" class="form-control select2 listar-ativos template template_id_ativo_externo">
                <option>Pesquise o Item desejado</option>
            </select>
        </div>
        <div class="col-1">
            <input type="number" value="" name="quantidade[]" class="form-control text_quantidade">
        </div>
    </div>
</template>
@endsection