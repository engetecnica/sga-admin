@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
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
                                <label class="form-label" for="obra">Obra</label> <button class="badge badge-primary" data-toggle="modal" data-target="#modal-add" type="button"><i class="mdi mdi-plus"></i></button>
                                <select class="form-select" id="obra" name="obra">
                                    @if (@$store->obra)
                                        <option value="{{ $store->obra }}" selected>{{ $store->obra->codigo_obra }} | {{ $store->obra->razao_social }}
                                        </option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif
                                    @foreach ($obras as $obra)
                                        <option value="{{ $obra->id }}">{{ $obra->codigo_obra }} | {{ $obra->razao_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label class="form-label" for="periodo_inicial">Período do Veículo Alocado - Inicial</label>
                                <input class="form-control" id="periodo_inicial" name="periodo_inicial" type="date" value="{{ old('periodo_inicial', @$store->periodo_inicial) }}">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" for="periodo_final">Período do Veículo Alocado - Final</label>
                                <input class="form-control" id="periodo_final" name="periodo_final" type="date" value="{{ old('periodo_final', @$store->periodo_final) }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="tipo">Tipo</label>
                                <select class="form-select" id="tipo" name="tipo" onchange="mostrarEsconderInputs()">
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
                            <div class="col-md-4" id="marcaVeiculos">
                                <label class="form-label" for="marca">Marca</label>
                                <select class="form-select" id="marca" name="marca">

                                    @if (@$store->marca)
                                        <option value="{{ $store->marca }}" selected>{{ $store->marca }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif

                                </select>
                                <input id="marca_nome" name="marca_nome" type="hidden">
                            </div>
                            <div class="col-md-4" id="marcaMaquinas" style="display:none;">
                                <label class="form-label" for="marca">Marca</label> <button class="badge badge-primary" data-toggle="modal" data-target="#addMarcaModal" type="button"><i class="mdi mdi-plus"></i></button>
                                <select class="form-select" id="marca_da_maquina" name="marca_da_maquina">
                                    @if (@$store->marca_da_maquina)
                                        <option value="{{ $store->marca_da_maquina }}" selected>
                                            {{ $store->marca_da_maquina }}
                                        </option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->marca }}">{{ $marca->marca }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4" id="modeloVeiculos">
                                <label class="form-label" for="modelo">Modelo</label>
                                <select class="form-select" id="modelo" name="modelo">

                                    @if (@$store->modelo)
                                        <option value="{{ $store->modelo }}" selected>{{ $store->modelo }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif

                                </select>
                                <input id="modelo_nome" name="modelo_nome" type="hidden">
                            </div>
                            <div class="col-md-4" id="modeloMaquinas" style="display:none;">
                                <label class="form-label" for="modelo_da_maquina">Modelo</label>
                                <select class="form-select" id="modelo_da_maquina" name="modelo_da_maquina">
                                    @if (@$store->modelo)
                                        <option value="{{ $store->modelo }}" selected>
                                            {{ $store->modelo }}
                                        </option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif
                                    @foreach ($modelos as $modelo)
                                        <option value="{{ $modelo->modelo }}">{{ $modelo->modelo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4" id="anoVeiculos">
                                <label class="form-label" for="ano">Ano</label>
                                <select class="form-select" id="ano" name="ano">
                                    @if (@$store->ano)
                                        <option value="{{ $store->ano }}" selected>{{ $store->ano }}</option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4" id="anoMaquinas" style="display:none;">
                                <label class="form-label" for="ano_da_maquina">Ano</label>
                                <select class="form-select" id="ano_da_maquina" name="ano_da_maquina">
                                    @if (@$store->ano)
                                        <option value="{{ $store->ano }}" selected>{{ $store->ano }}</option>
                                    @else
                                        <option value="">Selecione</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-8" id="nomeVeiculos">
                                <label class="form-label" for="veiculo">Veículo</label>
                                <input class="form-control" id="veiculo" name="veiculo" type="veiculo" value="{{ old('veiculo', @$store->veiculo) }}" readonly placeholder="Preenchimento Automático">
                            </div>
                            <div class="col-md-8" id="nomeMaquinas">
                                <label class="form-label" for="veiculo_maquina">Modelo/Ano</label>
                                <input class="form-control" id="veiculo_maquina" name="veiculo_maquina" type="veiculo_maquina" value="{{ old('veiculo_maquina', @$store->veiculo) }}" readonly placeholder="Preenchimento Automático">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="valor_fipe1">Valor</label>
                                <input class="form-control" id="valor_fipe1" name="valor_fipe" type="text" value="{{ old('valor_fipe', @$store->valor_fipe) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="codigo_fipe">Código</label>
                                <input class="form-control" id="codigo_fipe" name="codigo_fipe" type="text" value="{{ old('codigo_fipe', @$store->codigo_fipe) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="fipe_mes_referencia">Mês de referência</label>
                                <input class="form-control" id="fipe_mes_referencia" name="fipe_mes_referencia" type="text" value="{{ old('fipe_mes_referencia', @$store->fipe_mes_referencia) }}">
                            </div>
                        </div>

                        <div class="row mt-3" id="divPlacaRenavam" style="display:none;">
                            <div class="col-md-4">
                                <label class="form-label" for="placa">Placa</label>
                                <input class="form-control text-uppercase" id="placa" name="placa" type="text" value="{{ old('placa', @$store->placa) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="renavam">Renavam</label>
                                <input class="form-control" id="renavam" name="renavam" type="text" value="{{ old('renavam', @$store->renavam) }}">
                            </div>
                            @if (!@$store)
                                <div class="col-md-4">
                                    <label class="form-label" for="quilometragem_atual">
                                        Quilometragem Inicial
                                    </label>
                                    <input class="form-control" id="quilometragem_atual" name="quilometragem_atual" type="number" value="{{ old('quilometragem_atual', @$store->quilometragem->quilometragem_atual) }}">
                                </div>
                            @endif
                        </div>

                        <div class="row mt-3" id="divHorimetro" style="display:none;">
                            <div class="col-md-2">
                                <label class="form-label" for="horimetro_inicial">Horímetro inicial</label>
                                <input class="form-control" id="horimetro_inicial" name="horimetro_inicial" type="text" value="{{ old('horimetro_inicial', @$store->horimetro_inicial) }}" step="60">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="codigo_da_maquina">ID da Máquina</label>
                                <input class="form-control" id="codigo_da_maquina" name="codigo_da_maquina" type="text" value="{{ old('codigo_da_maquina', @$store->codigo_da_maquina) }}">
                            </div>
                            {{-- <div class="col-md-3">
                                <label for="marca_da_maquina" class="form-label">Marca</label>
                                <select name="marca_da_maquina" id="marca_da_maquina" class="form-select">
                                    @if (@$store->marca_da_maquina)
                                        <option value="{{ $store->marca_da_maquina }}" selected>
                                            {{ $store->marca_da_maquina }}
                                        </option>
                                    @else
                                        <option value="" selected>Selecione</option>
                                    @endif
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->marca }}">{{ $marca->marca }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary position-absolute fixed-bottom"
                                    data-toggle="modal" data-target="#addMarcaModal"><span
                                        class="mdi mdi-plus"></span></button>

                            </div> --}}
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8">
                                <label class="form-label" for="observacao">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao" cols="30" rows="6">{{ @$store->observacao }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label class="form-label" for="situacao">Situação</label>
                                <select class="form-select" id="situacao" name="situacao">
                                    <option value="Ativo" selected>Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
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

    {{-- MODAL INCLUSAO RAPIDA DE OBRAS --}}
    @include('pages.cadastros.obra.partials.inclusao-rapida')
    @include('pages.ativos.veiculos.marca-inclusao-rapida')

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tipo').on('change', function() {
            var tipo = $(this).val();
            if (tipo == 'motos' || tipo == 'carros' || tipo == 'caminhoes') {
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
                $('#marcaVeiculo').hide();
                $('#modeloVeiculo').hide();
                $('#modeloMaquina').hide();
                $('#marcaMaquina').hide();
                $('#valor_fipe1').val('R$ ');
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
                        $('#valor_fipe').val(data.Valor.replace(/[^\d\,]/g, '').replace(',', '.'));
                        $('#valor_fipe1').val(data.Valor);
                        $('#codigo_fipe').val(data.CodigoFipe);
                        $('#fipe_mes_referencia').val(data.MesReferencia);
                    }
                });
            } else {
                $('#veiculo').val('');
                $('#valor_fipe1').val('R$ ');
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
            document.getElementById("divHorimetro").style.display = "";
        } else {
            document.getElementById("divPlacaRenavam").style.display = "none";
            document.getElementById("divHorimetro").style.display = "none";
        }
        var tipo = document.getElementById("tipo").value;
        if (tipo === "maquinas") {
            document.getElementById("marcaMaquinas").style.display = "block";
            document.getElementById("marcaVeiculos").style.display = "none";
        } else {
            document.getElementById("marcaMaquinas").style.display = "none";
            document.getElementById("marcaVeiculos").style.display = "block";
        }
        var tipo = document.getElementById("tipo").value;
        if (tipo === "maquinas") {
            document.getElementById("modeloMaquinas").style.display = "block";
            document.getElementById("modeloVeiculos").style.display = "none";
        } else {
            document.getElementById("modeloMaquinas").style.display = "none";
            document.getElementById("modeloVeiculos").style.display = "block";
        }
        var tipo = document.getElementById("tipo").value;
        if (tipo === "maquinas") {
            document.getElementById("anoMaquinas").style.display = "block";
            document.getElementById("anoVeiculos").style.display = "none";
        } else {
            document.getElementById("anoMaquinas").style.display = "none";
            document.getElementById("anoVeiculos").style.display = "block";
        }
        var tipo = document.getElementById("tipo").value;
        if (tipo === "maquinas") {
            document.getElementById("nomeMaquinas").style.display = "block";
            document.getElementById("nomeVeiculos").style.display = "none";
        } else {
            document.getElementById("nomeMaquinas").style.display = "none";
            document.getElementById("nomeVeiculos").style.display = "block";
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#addMarcaModal').on('hidden.bs.modal', function(e) {
            $('#add_marca_da_maquina').val('');
        });
    });
</script>
<script>
    $(document).ready(function() {
        var modeloSelect = $("#modelo_da_maquina");
        var anoSelect = $("#ano_da_maquina");
        var veiculoInput = $("#veiculo_maquina");

        modeloSelect.on("change", updateVeiculo);
        anoSelect.on("change", updateVeiculo);

        function updateVeiculo() {
            var modeloValue = modeloSelect.val();
            var anoValue = anoSelect.val();
            veiculoInput.val(modeloValue + '/' + anoValue);
        }
    });
</script>
