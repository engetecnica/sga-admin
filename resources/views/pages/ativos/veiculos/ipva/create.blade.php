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

                    <form method="post" action="{{ route('ativo.veiculo.ipva.store') }}">
                        @csrf
                        <div class="jumbotron p-3">
                            <span class="font-weight-bold">{{ $veiculo->marca }} | {{ $veiculo->modelo }} | {{ $veiculo->veiculo }}</span>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="form-label" for="referencia_ano">Ano de Referência</label>
                                <input class="form-control" id="referencia_ano" name="referencia_ano" type="number" value="{{ old('referencia_ano') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="valor">Valor</label>
                                <input class="form-control" id="valor" name="valor" type="text" value="{{ old('valor') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="data_de_vencimento">Data de Vencimento</label>
                                <input class="form-control" id="data_de_vencimento" name="data_de_vencimento" type="date" value="{{ old('data_de_vencimento') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="data_de_pagamento">Data de Pagamento</label>
                                <input class="form-control" id="data_de_pagamento" name="data_de_pagamento" type="date" value="{{ old('data_de_pagamento') }}">
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <input name="veiculo_id" type="hidden" value="{{ $veiculo->id }}">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium" type="submit">Salvar</button>

                            <a href="{{ route('ativo.veiculo') }}">
                                <button class="btn btn-gradient-danger btn-lg font-weight-medium" type="button">Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
