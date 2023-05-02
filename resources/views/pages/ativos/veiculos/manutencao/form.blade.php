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

                    @php
                        $action = isset($store->manutencao) ? route('ativo.veiculo.manutencao.update', $store->id) : route('ativo.veiculo.manutencao.store', $store->id);
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf


                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="tipo" class="form-label">Tipo </label>
                                <select name="tipo" id="tipo" class="form-select">
                                    <option value="" @if (!isset($store->manutencao) || !$store->manutencao->tipo) selected @endif>Selecione
                                    </option>
                                    <option value="corretiva" @if (isset($store->manutencao) && $store->manutencao->tipo == 'corretiva') selected @endif>Corretiva
                                    </option>
                                    <option value="preventiva" @if (isset($store->manutencao) && $store->manutencao->tipo == 'preventiva') selected @endif>Preventiva
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="fornecedor" class="form-label">Fornecedor</label>
                                <select name="fornecedor" id="fornecedor" class="form-select">
                                    <option value="" selected>Selecione</option>
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor->id }}"
                                            @if ($store->manutencao && $store->manutencao->fornecedor && $fornecedor->id == $store->manutencao->fornecedor->id) selected @endif>
                                            {{ $fornecedor->razao_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="servico" class="form-label">Serviço</label>
                                <select name="servico" id="servico" class="form-select">
                                    <option value="" selected>Selecione</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}"
                                            @if ($store->manutencao && $store->manutencao->servico && $servico->id == $store->manutencao->servico->id) selected @endif>
                                            {{ $servico->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        @if (@$store->tipo == 'maquinas')
                            <div class="row  mt-3">
                                <div class="col-md-4">
                                    <label for="horimetro_atual" class="form-label">Horímetro Atual</label>
                                    <input type="time" class="form-control" id="horimetro_atual"
                                        value="{{ old('horimetro_atual', @$store->manutencao->horimetro_atual) }}"
                                        name="horimetro_atual" step="60">
                                </div>
                                <div class="col-md-4">
                                    <label for="horimetro_proximo" class="form-label">Horímetro Próximo</label>
                                    <input type="time" class="form-control" id="horimetro_proximo"
                                        value="{{ old('horimetro_proximo', @$store->manutencao->horimetro_proximo) }}"
                                        name="horimetro_proximo" step="60">
                                </div>
                            </div>
                        @else
                            <div class="row  mt-3">
                                <div class="col-md-4">
                                    <label for="quilometragem_atual" class="form-label">Quilometragem Atual</label>
                                    <input type="number" class="form-control" id="quilometragem_atual"
                                        value="{{ old('quilometragem_atual', @$store->manutencao->quilometragem_atual) }}"
                                        name="quilometragem_atual">
                                </div>

                                <div class="col-md-4">
                                    <label for="quilometragem_proxima" class="form-label">Quilometragem Nova</label>
                                    <input type="number" class="form-control" id="quilometragem_proxima"
                                        value="{{ old('quilometragem_proxima', @$store->manutencao->quilometragem_proxima) }}"
                                        name="quilometragem_proxima">
                                </div>
                            </div>
                        @endif


                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="data_de_execucao" class="form-label">Data de Execução</label>
                                <input type="date" class="form-control" id="data_de_execucao"
                                    value="{{ old('data_de_execucao', @$store->manutencao->data_de_execucao) }}"
                                    name="data_de_execucao">
                            </div>
                            <div class="col-md-4">
                                <label for="data_de_vencimento" class="form-label">Data de Vencimento</label>
                                <input type="date" class="form-control" id="data_de_vencimento"
                                    value="{{ old('data_de_vencimento', @$store->manutencao->data_de_vencimento) }}"
                                    name="data_de_vencimento">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-8">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea name="descricao" id="descricao" cols="30" rows="6" class="form-control">{{ optional($store->manutencao)->descricao }}</textarea>
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="valor_do_servico" class="form-label">Valor do Serviço</label>
                                <input type="text" class="form-control" id="valor_do_servico"
                                    value="{{ old('valor_do_servico', @$store->manutencao->valor_do_servico) }}"
                                    name="valor_do_servico" step="any">
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
