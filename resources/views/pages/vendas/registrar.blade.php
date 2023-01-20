@extends('dashboard')
@section('title', 'PDV - Registrar nova Venda')
@section('content')

<style type="text/css">
    .hide {
        display: none;
    }
</style>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Registrar Venda
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Registrando nova Venda<i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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

                @php $action = isset($store) ? url('venda/update/'.$store->id) : url('venda/store');
                @endphp
                <form id="formulario" class="row g-3" method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf


                    <div class="col-md-12">
                        <label for="id_empresa" class="form-label">Empresa / Líder</label>
                        <select class="form-select select2 form-select2-lista " id="id_empresa" name="id_empresa">
                            <option>Empresa Líder</option>
                            @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nome }} - {{ $empresa->cpf }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="listagem hide">
                        <div class="row pt-5 item-lista">
                            <div class="col-md-4">
                                <label for="id_produto" class="form-label">Produto</label>
                                <select class="form-select select2 lista-produtos" name="id_produto">

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="id_cliente" class="form-label">Cliente</label>
                                <select class="form-select select2 lista-clientes" name="id_cliente">
                                    <option>Selecione um Cliente</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome . ' - ' . $cliente->celular }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" for="data_compra">Data da Compra</label>
                                <input type="date" class="form-control" name="data_compra" id="data_compra">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-sm btn-danger btn-margin-top-35 clonador"><span class="mdi mdi-plus"></span></button>
                            </div>


                        </div>
                    </div>




                    <div id="lista_vendas"></div>


                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium btn-salvar" disabled>Salvar</button>

                        <a href="{{ route('venda.pontodevenda') }}">
                            <button type="button" class="btn btn-block btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<template id="listagem-template">
    <div class="row  item-lista" style="margin-top:10px!important">
        <div class="col-md-4">
            <select class="form-select select2 lista-produtos" name="id_produto[]">

            </select>
        </div>

        <div class="col-md-4">
            <select class="form-select select2 lista-clientes" name="id_cliente[]">
                <option>Selecione um Cliente</option>
            </select>
        </div>

        <div class="col-md-2">
            <input type="date" class="form-control" name="data_compra" id="data_compra">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-danger btn-margin-top-35 clonador" style="margin-top: 3px;"><span class="mdi mdi-plus"></span></button>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-danger btn-margin-top-35 remove" style="margin-top: 3px;"><span class="mdi mdi-minus"></span></button>
        </div>


    </div>
</template>

<div id="savar_venda" class="box_venda hide">
    <div class=" row venda_linha">
        <div class="col-md-4">
            <select class="form-select select2" id="id_produto" name="id_produto">

            </select>
        </div>

        <div class="col-md-4">
            <select class="form-select select2" id="id_cliente" name="id_cliente">
                <option>Selecione um Cliente</option>
                @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nome . ' - ' . $cliente->celular }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="date" class="form-control" name="data_compra" id="data_compra">
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-danger btn-margin-top-35 remover"><span class="mdi mdi-minus"></span></button>
        </div>
    </div>
</div>

@endsection