@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span>
            @if ($veiculo->tipo == 'maquinas')
                IPVA da Máquina
            @else
                IPVA do Veículo
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    Ativos <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            <a class="btn btn-sm btn-danger" href="{{ route('ativo.veiculo.ipva.adicionar', $veiculo->id) }}">
                Adicionar
            </a>
        </h3>
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

                    {{-- DADOS DO VEÍCULO/MÁQUINA --}}
                    @include('pages.ativos.veiculos.partials.header')

                    <table class="table-hover table-striped table">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>Ano</th>
                                <th>Custo</th>
                                <th>Pagamento</th>
                                <th>Vencimento</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ipvas as $ipva)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $ipva->id }}</span></td>
                                    <td>{{ $ipva->referencia_ano }}</td>
                                    <td>R$ {{ Tratamento::formatFloat($ipva->valor) }}</td>
                                    <td>{{ Tratamento::dateBr($ipva->data_de_pagamento) }}</td>
                                    <td>{{ Tratamento::dateBr($ipva->data_de_vencimento) }}</td>

                                    <td class="d-flex gap-2">
                                        <a href="{{ route('ativo.veiculo.ipva.editar', $ipva->id) }}">
                                            <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar
                                            </button>
                                        </a>

                                        <form action="{{ route('ativo.veiculo.ipva.delete', $ipva->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a class="excluir-padrao" data-id="{{ $ipva->id }}" data-table="empresas" data-module="cadastro/empresa">
                                                <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                                    <i class="mdi mdi-delete"></i> Excluir
                                                </button>
                                            </a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
