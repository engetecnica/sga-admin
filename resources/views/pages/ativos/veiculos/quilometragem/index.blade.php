@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Quilometragem do veículo
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-success">
                        <a class="text-white" href="{{ route('ativo.veiculo.quilometragem.editar', [$last->id, 'add']) }}">
                            Adicionar
                        </a>
                    </button>
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

                    @if ($veiculo->tipo == 'maquinas')
                        <table class="table-hover table-striped table">
                            <thead>
                                <tr>
                                    <th width="8%">ID Máquina</th>
                                    <th>Horímetro Atual</th>
                                    <th>Marca</th>
                                    <th>Data</th>
                                    <th width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><span class="badge badge-dark">{{ @$store->codigo_da_maquina }}</span></td>

                                    <td>{{ @$veiculo->horimetro_inicial }}</td>
                                    <td>{{ @$veiculo->marca }}</td>
                                    <td>{{ @$veiculo->created_at }}</td>

                                    <td>editar/excluir</td>
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
                                    <th width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-dark">{{ @$veiculo->placa }}</span></td>
                                    <td>{{ $last->quilometragem_nova }} km</td>
                                    <td>R$ {{ Tratamento::formatFloat($veiculo->valor_fipe) }}</td>
                                    <td>{{ Tratamento::datetimeBr($last->created_at) }}</td>
                                    <td>editar/excluir</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    <table class="table-hover table-striped table" id="lista-simples">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>KM atual</th>
                                <th>Data</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($store as $quilometragem)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $quilometragem->id }}</span></td>

                                    <td>{{ @$quilometragem->quilometragem_nova }} Km</td>

                                    <td>{{ Tratamento::datetimeBr($quilometragem->created_at) }}</td>
                                    <td class="d-flex gap-2">
                                        @if ($loop->last)
                                            <a href="{{ route('ativo.veiculo.quilometragem.editar', [$quilometragem->id, 'edit']) }}">
                                                <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="mdi mdi-pencil"></i> Editar
                                                </button>
                                            </a>
                                        @endif
                                        <form action="{{ route('ativo.veiculo.quilometragem.delete', $quilometragem->id) }}" method="POST">
                                            @csrf
                                            <a class="excluir-padrao" data-id="{{ $quilometragem->id }}" data-table="empresas" data-module="cadastro/empresa">
                                                <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir">
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
