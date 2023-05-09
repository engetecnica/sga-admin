@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Manutenção do Veículo
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Cadastros <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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
                        <table class="table table-hover table-striped">
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

                                    <td>{{ @$store->horimetro_inicial }}</td>
                                    <td>{{ @$store->marca }}</td>
                                    <td>{{ @$store->created_at }}</td>

                                    <td>editar/excluir</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table table-hover table-striped">
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
                                    <td><span class="badge badge-dark">{{ @$store->placa }}</span></td>
                                    <td>
                                        @foreach ($store->quilometragens as $quilometragem)
                                            @if ($loop->last)
                                                {{ @$quilometragem->quilometragem_atual }} Km
                                            @endif
                                        @endforeach

                                    </td>
                                    <td>R$
                                        {{ number_format(floatval(str_replace(',', '.', str_replace('.', '', @$store->valor_fipe))), 2, ',', '.') }}
                                    </td>
                                    <td>{{ strftime('%d/%m/%Y às %H:%M', strtotime(@$store->created_at)) }}</td>
                                    <td>editar/excluir</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                    <table class="table table-hover table-striped" id="lista-simples">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>Mês Referência</th>
                                <th>Valor Fipe</th>
                                <th>Depreciação em %</th>
                                <th>Depreciação em R$</th>
                                <th>Data</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($store->depreciacaos as $depreciacao)
                                @php
                                    $meses = [
                                        'January' => 'Janeiro',
                                        'February' => 'Fevereiro',
                                        'March' => 'Março',
                                        'April' => 'Abril',
                                        'May' => 'Maio',
                                        'June' => 'Junho',
                                        'July' => 'Julho',
                                        'August' => 'Agosto',
                                        'September' => 'Setembro',
                                        'October' => 'Outubro',
                                        'November' => 'Novembro',
                                        'December' => 'Dezembro',
                                    ];
                                    
                                @endphp
                                <tr>
                                    <td><span class="badge badge-dark">{{ @$depreciacao->id }}</span></td>
                                    <td>{{ @$meses[$depreciacao->referencia_mes] }}</td>

                                    <td>R$
                                        {{ number_format(floatval(str_replace(',', '.', str_replace('.', '', @$depreciacao->valor_atual))), 2, ',', '.') }}
                                    </td>


                                    <td>A fazer</td>
                                    <td>A fazer</td>
                                    <td>{{ strftime('%d/%m/%Y', strtotime(@$depreciacao->created_at)) }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('ativo.veiculo.depreciacao.editar', $depreciacao->id) }}">
                                            <button class="badge badge-info" data-toggle="tooltip" data-placement="top"
                                                title="Editar"><i class="mdi mdi-pencil"></i> Editar
                                            </button>
                                        </a>
                                        <form action="{{ route('ativo.veiculo.depreciacao.delete', $depreciacao->id) }}"
                                            method="POST">
                                            @csrf
                                            <a class="excluir-padrao" data-id="{{ $depreciacao->id }}"
                                                data-table="empresas" data-module="cadastro/empresa">
                                                <button class="badge badge-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Excluir" type="submit"><i
                                                        class="mdi mdi-delete"></i>
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