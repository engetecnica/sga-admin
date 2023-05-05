@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Abastecimento do Veículo
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
                        $action = isset($store) ? route('ativo.veiculo.abastecimento.update', $store->id) : route('ativo.veiculo.abastecimento.store', $store->id);
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf
                        {{ $store->combustivel }}
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="combustivel" class="form-label">Fornecedor</label>
                                {{-- retorna o nome do fornecedor relacionado com o abastecimento de veiculo --}}
                                {{-- {{ $store->fornecedor->razao_social }} --}}
                                <select name="fornecedor" id="fornecedor" class="form-select">
                                    <option value="" selected>Selecione</option>
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor->id }}"
                                            @if (
                                                $store &&
                                                    $store->fornecedor &&
                                                    $fornecedor->id == $store->fornecedor->id) selected @endif>
                                            {{ $fornecedor->razao_social }}</option>
                                    @endforeach
                                </select>



                            </div>

                            <div class="col-md-4">
                                <label for="combustivel" class="form-label">Tipo de Combustível</label>
                                <select name="combustivel" id="combustivel" class="form-select">
                                    <option value="" @if (!isset($store) || !$store->combustivel) selected @endif>Selecione
                                    </option>

                                    <option value="etanol_alcool" @if (isset($store) && $store->combustivel == 'etanol_alcool') selected @endif>
                                        Etanol/Alcool</option>
                                    <option value="gasolina" @if (isset($store) && $store->combustivel == 'gasolina') selected @endif>Gasolina
                                    </option>
                                    <option value="diesel" @if (isset($store) && $store->combustivel == 'diesel') selected @endif>Diesel</option>
                                    <option value="gnv" @if (isset($store) && $store->combustivel == 'gnv') selected @endif>GNV</option>

                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="quilometragem" class="form-label">Quilometragem Atual</label>
                                <input type="number" step="any" class="form-control" id="quilometragem"
                                    value="{{ old('quilometragem', @$store->quilometragem) }}"
                                    name="quilometragem">
                            </div>
                            <div class="col-md-4">
                                <label for="valor_do_litro" class="form-label">Valor do litro</label>
                                <input type="text" step="any" class="form-control" id="valor_do_litro"
                                    value="{{ old('valor_do_litro', @$store->valor_do_litro) }}"
                                    name="valor_do_litro">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade"
                                    value="{{ old('quantidade', @$store->quantidade) }}" name="quantidade">
                            </div>
                            <div class="col-md-4">
                                <label for="valor_total" class="form-label">Valor total</label>
                                <input type="text" step="any" readonly class="form-control" id="valor_total"
                                    value="{{ old('valor_total', @$store->valor_total) }}"
                                    name="valor_total">
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
