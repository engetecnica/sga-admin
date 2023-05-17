@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Abastecimento do Veículo
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="btn btn-success" href="{{ route('ativo.veiculo.abastecimento.editar', [$last->id, 'add']) }}">
                        Adicionar
                    </a>
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

                    @if ($store->tipo == 'maquinas')
                        <table class="table-hover table-striped table">
                            <thead>
                                <tr>
                                    <th width="8%">ID Máquina</th>
                                    <th>Horímetro Atual</th>
                                    <th>Marca</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><span class="badge badge-dark">{{ @$store->codigo_da_maquina }}</span></td>

                                    <td>{{ @$store->horimetro_inicial }}</td>
                                    <td>{{ @$store->marca }}</td>
                                    <td>{{ @$store->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table-hover table-striped table">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>KM atual</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-dark">{{ @$store->placa }}</span></td>
                                    <td>
                                        @foreach ($store->quilometragens as $quilometragem)
                                            @if ($loop->last)
                                                {{ @$quilometragem->quilometragem_atual }} Km
                                            @endif
                                        @endforeach

                                    </td>
                                    <td>R$
                                        {{ Tratamento::formatFloat($store->valor_fipe) }}
                                    </td>
                                    <td>{{ Tratamento::datetimeBr($store->created_at) }}</td>

                                </tr>
                            </tbody>
                        </table>
                    @endif

                    <table class="table-hover table-striped table" id="lista-simples">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>Combustível</th>
                                <th>Unidades (L/M³)</th>
                                <th>Custo</th>
                                <th>Data</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($store->abastecimentos as $abastecimento)
                                <tr>
                                    <td><span class="badge badge-dark">{{ @$abastecimento->id }}</span></td>
                                    <td>{{ @$abastecimento->combustivel }}</td>
                                    <td>{{ @$abastecimento->quantidade }} M³</td>
                                    <td>R$
                                        {{ Tratamento::formatFloat($abastecimento->valor_total) }}
                                    </td>
                                    <td>{{ Tratamento::datetimeBr($abastecimento->created_at) }}</td>
                                    <td class="d-flex gap-2">
                                        @if ($loop->last)
                                            <a href="{{ route('ativo.veiculo.abastecimento.editar', [$abastecimento->id, 'edit']) }}">
                                                <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar
                                                </button>
                                            </a>
                                        @endif
                                        <form action="{{ route('ativo.veiculo.abastecimento.delete', $abastecimento->id) }}" method="POST">
                                            @csrf
                                            <a class="excluir-padrao" data-id="{{ $abastecimento->id }}" data-table="empresas" data-module="cadastro/empresa">
                                                <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir"><i class="mdi mdi-delete"></i>
                                                    Excluir</button>
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
