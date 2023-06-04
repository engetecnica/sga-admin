@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span>
            @if ($abastecimento->veiculo->tipo == 'maquinas')
                Abastecimento da Máquina
            @else
                Abastecimento do Veículo
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    Ativos
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

                    <form method="post" action="{{ route('ativo.veiculo.abastecimento.update', $abastecimento->id) }}">
                        @csrf
                        @method('put')
                        <div class="jumbotron p-3">
                            <span class="font-weight-bold">{{ $abastecimento->veiculo->marca }} | {{ $abastecimento->veiculo->modelo }} | {{ $abastecimento->veiculo->veiculo }}</span>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label class="form-label" for="fornecedor_id">Fornecedor</label>
                                <select class="form-select select2" id="fornecedor_id" name="fornecedor_id">
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor->id }}" {{ $abastecimento->fornecedor->id == $fornecedor->id ? 'selected' : '' }}>
                                            {{ $fornecedor->razao_social }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="combustivel">Tipo de Combustível</label>
                                <select class="form-select" id="combustivel" name="combustivel">
                                    <option value="etanol_alcool" {{ $abastecimento->combustivel == 'etanol_alcool' ? 'selected' : '' }}>Etanol/Alcool</option>
                                    <option value="gasolina" {{ $abastecimento->combustivel == 'gasolina' ? 'selected' : '' }}>Gasolina</option>
                                    <option value="diesel" {{ $abastecimento->combustivel == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="gnv" {{ $abastecimento->combustivel == 'gnv' ? 'selected' : '' }}>GNV</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem">{{ $abastecimento->veiculo->tipo == 'maquinas' ? 'Horímetro' : 'Quilometragem' }} Atual</label>
                                <input class="form-control" id="quilometragem" name="quilometragem" type="number" value="{{ $abastecimento->quilometragem }}" step="any">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="valor_do_litro">Valor do litro</label>
                                <input class="form-control" id="valor_do_litro" name="valor_do_litro" type="text" value="{{ $abastecimento->valor_do_litro }}" step="any">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="quantidade">Quantidade</label>
                                <input class="form-control" id="quantidade" name="quantidade" type="number" value="{{ $abastecimento->quantidade }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="valor_total">Valor total</label>
                                <input class="form-control" id="valor_total" name="valor_total" type="text" value="{{ $abastecimento->valor_total }}" step="any" readonly>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <input name="veiculo_id" type="hidden" value="{{ $abastecimento->veiculo->id }}">
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
