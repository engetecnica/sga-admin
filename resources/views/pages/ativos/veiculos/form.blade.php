@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Cadastro de Veículo
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
                        $action = isset($store) ? route('ativo.veiculo.update', $store->id) : route('ativo.veiculo.store');
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-10">
                                <label for="obra" class="form-label">Obra</label>
                                <select name="obra" id="obra" class="form-select">
                                    @foreach ($obras as $obra)
                                        <option value="{{ $obra->id }}">{{ $obra->razao_social }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-5">
                                <label for="periodo_inicial" class="form-label">Período do Veículo Alocado - Inicial</label>
                                <input type="date" class="form-control" id="periodo_inicial"
                                    value="{{ old('periodo_inicial', @$store->periodo_inicial) }}" name="periodo_inicial">
                            </div>
                            <div class="col-md-5">
                                <label for="periodo_final" class="form-label">Período do Veículo Alocado - Final</label>
                                <input type="date" class="form-control" id="periodo_final"
                                    value="{{ old('periodo_final', @$store->periodo_final) }}" name="periodo_final">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select name="tipo" id="tipo" class="form-select">
                                    <option value="" selected>Selecione</option>
                                    <option value="motos">Moto</option>
                                    <option value="carros">Carro</option>
                                    <option value="caminhoes">Caminhão</option>
                                    <option value="maquinas">Máquina</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="marca" class="form-label">Marca</label>
                                <select name="marca" id="marca" class="form-select">
                                    <option value="" selected>Selecione o tipo</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="modelo" class="form-label">Modelo</label>
                                <select name="modelo" id="modelo" class="form-select">
                                    <option value="" selected>Selecione o modelo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="ano" class="form-label">Ano</label>
                                <select name="ano" id="ano" class="form-select">
                                    <option value="">Selecione</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="veiculo" class="form-label">Veículo</label>
                                <input type="veiculo" class="form-control" id="veiculo"
                                    value="{{ old('veiculo', @$store->veiculo) }}" name="veiculo">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="valor_fipe" class="form-label">Valor</label>
                                <input type="number" class="form-control" id="valor_fipe"
                                    value="{{ old('valor_fipe', @$store->valor_fipe) }}" name="valor_fipe">
                            </div>
                            <div class="col-md-4">
                                <label for="codigo_fipe" class="form-label">Código</label>
                                <input type="text" class="form-control" id="codigo_fipe"
                                    value="{{ old('codigo_fipe', @$store->codigo_fipe) }}" name="codigo_fipe">
                            </div>
                            <div class="col-md-4">
                                <label for="fipe_mes_referencia" class="form-label">Mês de referência</label>
                                <input type="text" class="form-control" id="fipe_mes_referencia"
                                    value="{{ old('fipe_mes_referencia', @$store->fipe_mes_referencia) }}"
                                    name="fipe_mes_referencia">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="placa" class="form-label">Placa</label>
                                <input type="text" class="form-control" id="placa"
                                    value="{{ old('placa', @$store->placa) }}" name="placa">
                            </div>
                            <div class="col-md-4">
                                <label for="renavam" class="form-label">Renavam</label>
                                <input type="text" class="form-control" id="renavam"
                                    value="{{ old('renavam', @$store->renavam) }}" name="renavam">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="quilometragem_atual" class="form-label">

                                    @isset($store->quilometragem->quilometragem_atual)
                                        Quilometragem Atual
                                    @else
                                        Quilometragem Inicial
                                    @endisset
                                </label>
                                <input type="number" class="form-control" id="quilometragem_atual"
                                    value="{{ old('quilometragem_atual', @$store->quilometragem->quilometragem_atual) }}"
                                    name="quilometragem_atual">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="valor_funcionario" class="form-label">Valor Funcionário</label>
                                <input type="number" class="form-control" id="valor_funcionario"
                                    value="{{ old('valor_funcionario', @$store->valor_funcionario) }}"
                                    name="valor_funcionario">
                            </div>
                            <div class="col-md-4">
                                <label for="valor_adicional" class="form-label">Valor Adicional</label>
                                <input type="number" class="form-control" id="valor_adicional"
                                    value="{{ old('valor_adicional', @$store->valor_adicional) }}"
                                    name="valor_adicional">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-8">
                                <label for="valor_funcionario" class="form-label">Observação</label>
                                <textarea name="observacao" id="observacao" cols="30" rows="6" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-2">
                                <label for="situacao" class="form-label">Situação</label>
                                <select name="situacao" id="situacao" class="form-select">
                                    <option value="Ativo" selected>Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
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
        $('#tipo').on('change', function() {
            var tipo = $(this).val();
            if (tipo) {
                $.ajax({
                    url: 'https://parallelum.com.br/fipe/api/v1/' + tipo + '/marcas',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#marca').empty().append(
                            '<option value="" selected>Selecione a marca</option>');
                        $.each(data, function(key, value) {
                            $('#marca').append('<option value="' + value.codigo +
                                '">' + value.nome + '</option>');
                        });
                    }
                });
            } else {
                $('#marca').empty().append('<option value="" selected>Selecione o tipo</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#marca').on('change', function() {
            var tipo = $('#tipo').val();
            var marcaId = $(this).val();
            if (marcaId) {
                $.ajax({
                    url: 'https://parallelum.com.br/fipe/api/v1/' + tipo + '/marcas/' +
                        marcaId + '/modelos',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#modelo').empty().append(
                            '<option value="" selected>Selecione o modelo</option>');
                        $.each(data.modelos, function(key, value) {
                            $('#modelo').append('<option value="' + value.codigo +
                                '">' + value.nome + '</option>');
                        });
                    }
                });
            } else {
                $('#modelo').empty().append('<option value="" selected>Selecione o modelo</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#modelo').on('change', function() {
            var tipo = $('#tipo').val();
            var marcaId = $('#marca').val();
            var modeloId = $(this).val();
            if (modeloId) {
                $.ajax({
                    url: 'https://parallelum.com.br/fipe/api/v1/' + tipo + '/marcas/' +
                        marcaId + '/modelos/' + modeloId + '/anos',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#ano').empty().append(
                            '<option value="" selected>Selecione o ano</option>');
                        $.each(data, function(key, value) {
                            $('#ano').append('<option value="' + value.codigo +
                                '">' + value.nome + '</option>');

                        });
                    }
                });
            } else {
                $('#ano').empty().append('<option value="" selected>Selecione o ano</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#ano').on('change', function() {
            var tipo = $('#tipo').val();
            var marcaId = $('#marca').val();
            var modeloId = $('#modelo').val();
            var anoId = $(this).val();
            if (anoId) {
                $.ajax({
                    url: 'https://parallelum.com.br/fipe/api/v1/' + tipo + '/marcas/' +
                        marcaId + '/modelos/' + modeloId + '/anos/' + anoId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#veiculo').val(data.Modelo);
                        $('#valor_fipe').val(data.Valor.replace(/[^\d\,]/g, '').replace(',',
                            '.'));
                        $('#codigo_fipe').val(data.CodigoFipe);
                        $('#fipe_mes_referencia').val(data.MesReferencia);
                    }
                });
            } else {
                $('#veiculo').val('');
                $('#valor_fipe').val('');
                $('#codigo_fipe').val('');
                $('#fipe_mes_referencia').val('');
            }
        });
    });
</script>
