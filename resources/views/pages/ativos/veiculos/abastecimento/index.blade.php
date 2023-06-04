@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span>
            @if ($veiculo->tipo == 'maquinas')
                Abastecimento da Máquina
            @else
                Abastecimento do Veículo
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
            <a class="btn btn-sm btn-danger" href="{{ route('ativo.veiculo.abastecimento.adicionar', $veiculo->id) }}">
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
                                <th>Combustível</th>
                                <th>Unidades (L/M³)</th>
                                <th>Custo</th>
                                <th>Data</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abastecimentos as $abastecimento)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $abastecimento->id }}</span></td>
                                    <td>{{ $abastecimento->combustivel }}</td>
                                    <td>{{ $abastecimento->quantidade }} M³</td>
                                    <td>R$
                                        {{ Tratamento::formatFloat($abastecimento->valor_total) }}
                                    </td>
                                    <td>{{ Tratamento::datetimeBr($abastecimento->created_at) }}</td>
                                    <td class="d-flex gap-2">

                                        <a href="{{ route('ativo.veiculo.abastecimento.editar', $abastecimento->id) }}">
                                            <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="mdi mdi-pencil"></i> Editar
                                            </button>
                                        </a>

                                        @if ($loop->first)
                                            <form action="{{ route('ativo.veiculo.abastecimento.delete', $abastecimento->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="excluir-padrao" data-id="{{ $abastecimento->id }}" data-table="empresas" data-module="cadastro/empresa">
                                                    <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                                        <i class="mdi mdi-delete"></i>
                                                        Excluir</button>
                                                </a>
                                            </form>
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
