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
                    <a class="btn btn-success" href="{{ route('ativo.veiculo.abastecimento.index', $store->veiculo_id) }}">
                        <i class="mdi mdi-arrow-left icon-sm align-middle text-white"></i> Voltar
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

                    <form method="post" enctype="multipart/form-data" action="{{ $btn == 'add' ? route('ativo.veiculo.abastecimento.store', $store->veiculo_id) : route('ativo.veiculo.abastecimento.update', $store->id) }}">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="combustivel">Fornecedor</label>
                                {{-- retorna o nome do fornecedor relacionado com o abastecimento de veiculo --}}
                                {{-- {{ $store->fornecedor->razao_social }} --}}
                                <select class="form-select" id="fornecedor" name="fornecedor">
                                    <option value="" selected>Selecione</option>
                                    @if ($btn == 'add')
                                        @foreach ($fornecedores as $fornecedor)
                                            <option value="{{ $fornecedor->id }}">
                                                {{ $fornecedor->razao_social }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($fornecedores as $fornecedor)
                                            <option value="{{ $fornecedor->id }}" {{ $store->fornecedor->id == $fornecedor->id ? 'selected' : '' }}>
                                                {{ $fornecedor->razao_social }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="combustivel">Tipo de Combustível</label>
                                <select class="form-select" id="combustivel" name="combustivel">
                                    <option value="">Selecione</option>
                                    <option value="etanol_alcool" {{ ($btn == 'add' ? '' : $store->combustivel == 'etanol_alcool') ? 'selected' : '' }}>Etanol/Alcool</option>
                                    <option value="gasolina" {{ ($btn == 'add' ? '' : $store->combustivel == 'gasolina') ? 'selected' : '' }}>Gasolina</option>
                                    <option value="diesel" {{ ($btn == 'add' ? '' : $store->combustivel == 'diesel') ? 'selected' : '' }}>Diesel</option>
                                    <option value="gnv" {{ ($btn == 'add' ? '' : $store->combustivel == 'gnv') ? 'selected' : '' }}>GNV</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem">Quilometragem Atual</label>
                                <input class="form-control" id="quilometragem" name="quilometragem" type="number" value="{{ $btn == 'add' ? '' : @$store->quilometragem }}" step="any">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="valor_do_litro">Valor do litro</label>
                                <input class="form-control" id="valor_do_litro" name="valor_do_litro" type="text" value="{{ $btn == 'add' ? '' : @$store->valor_do_litro }}" step="any">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="quantidade">Quantidade</label>
                                <input class="form-control" id="quantidade" name="quantidade" type="number" value="{{ $btn == 'add' ? '' : @$store->quantidade }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="valor_total">Valor total</label>
                                <input class="form-control" id="valor_total" name="valor_total" type="text" value="{{ $btn == 'add' ? '' : @$store->valor_total }}" step="any" readonly>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var valorDoLitroInput = document.getElementById('valor_do_litro');
        var quantidadeInput = document.getElementById('quantidade');
        var valorTotalInput = document.getElementById('valor_total');

        valorDoLitroInput.addEventListener('change', updateValorTotal);
        quantidadeInput.addEventListener('change', updateValorTotal);

        function updateValorTotal() {
            var valorDoLitro = parseFloat(valorDoLitroInput.inputmask.unmaskedvalue());
            var quantidade = parseFloat(quantidadeInput.value);

            var valorTotal = valorDoLitro * quantidade;

            valorTotalInput.value = 'R$ ' + valorTotal.toFixed(2).replace('.', ',');
        }

    });
</script>
