@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> IPVA do veículo
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

                    @php
                        $action = isset($store) ? route('ativo.veiculo.ipva.update', $store->id) : route('ativo.veiculo.ipva.store', $store->id);
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf



                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="referencia_ano" class="form-label">Ano de Referência</label>
                                <input type="number" step="any" class="form-control" id="referencia_ano"
                                    value="{{ old('referencia_ano', @$store->referencia_ano) }}"
                                    name="referencia_ano">
                            </div>
                            <div class="col-md-4">
                                <label for="valor" class="form-label">Valor</label>
                                <input type="text" step="any" class="form-control" id="valor"
                                    value="{{ old('valor', @$store->valor) }}" name="valor">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="data_de_vencimento" class="form-label">Data de Vencimento</label>
                                <input type="date" class="form-control" id="data_de_vencimento"
                                    value="{{ old('data_de_vencimento', @$store->data_de_vencimento) }}"
                                    name="data_de_vencimento">
                            </div>
                            <div class="col-md-4">
                                <label for="data_de_pagamento" class="form-label">Data de Pagamento</label>
                                <input type="date" class="form-control" id="data_de_pagamento"
                                    value="{{ old('data_de_pagamento', @$store->data_de_pagamento) }}"
                                    name="data_de_pagamento">
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit"
                                class="btn btn-gradient-primary btn-lg font-weight-medium">Salvar</button>

                            <a href="{{ route('ativo.veiculo') }}">
                                <button type="button"
                                    class="btn btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var valorDoLitroInput = document.getElementById('valor_do_litro');
        var quantidadeInput = document.getElementById('quantidade');
        var valorTotalInput = document.getElementById('valor_total');

        valorDoLitroInput.addEventListener('change', updateValorTotal);
        quantidadeInput.addEventListener('change', updateValorTotal);

        function updateValorTotal() {
            var valorDoLitro = parseFloat(valorDoLitroInput.value);
            var quantidade = parseFloat(quantidadeInput.value);

            var valorTotal = valorDoLitro * quantidade;

            valorTotalInput.value = valorTotal.toFixed(2);
        }
    });
</script>
