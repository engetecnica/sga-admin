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
                                    @if (@$store->obra)
                                        <option value="{{ $store->obra }}" selected>{{ $store->obra->razao_social }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif
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
                                <select name="tipo" id="tipo" class="form-select"
                                    onchange="mostrarEsconderInputs()">
                                    @if (@$store->tipo)
                                        <option value="{{ $store->tipo }}" selected>{{ $store->tipo }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif
                                    <option value="motos">Moto</option>
                                    <option value="carros">Carro</option>
                                    <option value="caminhoes">Caminhão</option>
                                    <option value="maquinas">Máquina</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="marca" class="form-label">Marca</label>
                                <select name="marca" id="marca" class="form-select">

                                    @if (@$store->marca)
                                        <option value="{{ $store->marca }}" selected>{{ $store->marca }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif

                                </select>
                                <input type="hidden" name="marca_nome" id="marca_nome">

                            </div>

                            <div class="col-md-4">
                                <label for="modelo" class="form-label">Modelo</label>
                                <select name="modelo" id="modelo" class="form-select">

                                    @if (@$store->modelo)
                                        <option value="{{ $store->modelo }}" selected>{{ $store->modelo }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif

                                </select>
                                <input type="hidden" name="modelo_nome" id="modelo_nome">
                            </div>


                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="ano" class="form-label">Ano</label>
                                <select name="ano" id="ano" class="form-select">

                                    @if (@$store->ano)
                                        <option value="{{ $store->ano }}" selected>{{ $store->ano }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif

                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="veiculo" class="form-label">Veículo</label>
                                <input type="veiculo" class="form-control" id="veiculo" readonly
                                    value="{{ old('veiculo', @$store->veiculo) }}" name="veiculo"
                                    placeholder="Preenchimento Automático">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="valor_fipe" class="form-label">Valor</label>
                                <input type="text" class="form-control" id="valor_fipe" readonly
                                    value="{{ old('valor_fipe', @$store->valor_fipe) }}" name="valor_fipe"
                                    placeholder="Preenchimento Automático">
                            </div>
                            <div class="col-md-4">
                                <label for="codigo_fipe" class="form-label">Código</label>
                                <input type="text" class="form-control" id="codigo_fipe" readonly
                                    value="{{ old('codigo_fipe', @$store->codigo_fipe) }}" name="codigo_fipe"
                                    placeholder="Preenchimento Automático">
                            </div>
                            <div class="col-md-4">
                                <label for="fipe_mes_referencia" class="form-label">Mês de referência</label>
                                <input type="text" class="form-control" id="fipe_mes_referencia" readonly
                                    value="{{ old('fipe_mes_referencia', @$store->fipe_mes_referencia) }}"
                                    name="fipe_mes_referencia" placeholder="Preenchimento Automático">
                            </div>
                        </div>

                        <div class="row mt-3" id="divPlacaRenavam" style="display:none;">
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

                        <div class="row mt-3" id="divHorimetro" style="display:none;">
                            <div class="col-md-4">
                                <label for="horimetro_inicial" class="form-label">Horímetro inicial</label>
                                <input type="time" step="60" class="form-control" id="horimetro_inicial"
                                    value="{{ old('horimetro_inicial', @$store->horimetro_inicial) }}"
                                    name="horimetro_inicial">
                            </div>
                        </div>

                        @if (!@$store)
                            <div class="row  mt-3">
                                <div class="col-md-4">
                                    <label for="quilometragem_atual" class="form-label">
                                        Quilometragem Inicial
                                    </label>
                                    <input type="number" class="form-control" id="quilometragem_atual"
                                        value="{{ old('quilometragem_atual', @$store->quilometragem->quilometragem_atual) }}"
                                        name="quilometragem_atual">
                                </div>
                            </div>
                        @endif

                     

                        <div class="row  mt-3">
                            <div class="col-md-8">
                                <label for="observacao" class="form-label">Observação</label>
                                <textarea name="observacao" id="observacao" cols="30" rows="6" class="form-control">{{ @$store->observacao }}</textarea>
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

        $('#marca').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            $('#marca_nome').val(selectedOption.text());
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
                            $('#modelo_nome').val(value.nome);
                        });
                    }
                });
            } else {
                $('#modelo').empty().append('<option value="" selected>Selecione o modelo</option>');
            }
        });

        $('#modelo').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            $('#modelo_nome').val(selectedOption.text());
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
<script>
    function mostrarEsconderInputs() {
        var tipo = document.getElementById("tipo").value;
        if (tipo == "motos" || tipo == "carros" || tipo == "caminhoes") {
            document.getElementById("divPlacaRenavam").style.display = "";
            document.getElementById("divHorimetro").style.display = "none";
        } else if (tipo == "maquinas") {
            document.getElementById("divPlacaRenavam").style.display = "none";
            document.getElementById("divHorimetro").style.display = "block";
        } else {
            document.getElementById("divPlacaRenavam").style.display = "none";
            document.getElementById("divHorimetro").style.display = "none";
        }
    }
</script>
