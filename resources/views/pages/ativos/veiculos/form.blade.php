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

                    <form method="post" action="{{ route('ativo.veiculo.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-10">
                                <label class="form-label" for="obra">Obra</label> <button class="badge badge-primary" data-toggle="modal" data-target="#modal-add" type="button"><i class="mdi mdi-plus"></i></button>
                                <select class="form-select form-control select2" id="obra" name="obra" required>
                                    <option value="">Selecione</option>
                                    @foreach ($obras as $obra)
                                        <option value="{{ $obra->id }}" {{ old('obra') == $obra->id ? 'selected' : '' }}>{{ $obra->codigo_obra }} | {{ $obra->razao_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label class="form-label" for="periodo_inicial">Período do Veículo Alocado - Inicial</label>
                                <input class="form-control" id="periodo_inicial" name="periodo_inicial" type="date" value="{{ old('periodo_inicial') }}">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" for="periodo_final">Período do Veículo Alocado - Final</label>
                                <input class="form-control" id="periodo_final" name="periodo_final" type="date" value="{{ old('periodo_final') }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="tipo">Tipo</label>
                                <select class="form-select" id="tipo" name="tipo" onchange="mostrarEsconderInputs()" required>
                                    <option value="">Selecione</option>
                                    <option value="motos" {{ old('tipo') == 'motos' ? 'selected' : '' }}>Moto</option>
                                    <option value="carros" {{ old('tipo') == 'carros' ? 'selected' : '' }}>Carro</option>
                                    <option value="caminhoes" {{ old('tipo') == 'caminhoes' ? 'selected' : '' }}>Caminhão</option>
                                    <option value="maquinas" {{ old('tipo') == 'maquinas' ? 'selected' : '' }}>Máquina</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="marcaVeiculos">
                                <label class="form-label" for="marca">Marca</label>
                                <select class="form-select" id="marca" name="marca" required>
                                    <option value="">Selecione</option>
                                    <option value="{{ old('marca') }}" {{ old('marca') == old('marca') ? 'selected' : '' }}>{{ old('marca') }}</option>
                                </select>
                                <input id="marca_nome" name="marca_nome" type="hidden">
                            </div>
                            <div class="col-md-4" id="marcaMaquinas" style="display:none;">
                                <label class="form-label" for="marca">Marca</label> <button class="badge badge-primary" data-toggle="modal" data-target="#addMarcaModal" type="button"><i class="mdi mdi-plus"></i></button>
                                <select class="form-select" id="marca_da_maquina" name="marca_da_maquina">
                                    <option value="">Selecione</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->marca }}" {{ old('marca_da_maquina') == $marca->marca ? 'selected' : '' }}>{{ $marca->marca }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4" id="modeloVeiculos">
                                <label class="form-label" for="modelo">Modelo</label>
                                <select class="form-select" id="modelo" name="modelo" required>
                                    <option value="">Selecione</option>
                                    <option value="{{ old('modelo') }}" {{ old('modelo') == old('modelo') ? 'selected' : '' }}>{{ old('modelo') }}</option>
                                </select>
                                <input id="modelo_nome" name="modelo_nome" type="hidden">
                            </div>
                            <div class="col-md-4" id="modeloMaquinas" style="display:none;">
                                <label class="form-label" for="modelo_da_maquina">Modelo</label>
                                <select class="form-select" id="modelo_da_maquina" name="modelo_da_maquina">
                                    <option value="">Selecione</option>
                                    @foreach ($modelos as $modelo)
                                        <option value="{{ $modelo->modelo }}" {{ old('modelo_da_maquina') == $modelo->modelo ? 'selected' : '' }}>{{ $modelo->modelo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4" id="anoVeiculos">
                                <label class="form-label" for="ano">Ano</label>
                                <select class="form-select" id="ano" name="ano" required>
                                    <option value="">Selecione</option>
                                    <option value="{{ old('ano') }}" {{ old('ano') == old('ano') ? 'selected' : '' }}>{{ old('ano') }}</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="anoMaquinas" style="display:none;">
                                <label class="form-label" for="ano_da_maquina">Ano</label>
                                <select class="form-select" id="ano_da_maquina" name="ano_da_maquina">
                                    <option value="">Selecione</option>
                                    <option value="1987" {{ old('ano_da_maquina') == '1987' ? 'selected' : '' }}>1987</option>
                                    <option value="1988" {{ old('ano_da_maquina') == '1988' ? 'selected' : '' }}>1988</option>
                                    <option value="1989" {{ old('ano_da_maquina') == '1989' ? 'selected' : '' }}>1989</option>
                                    <option value="1990" {{ old('ano_da_maquina') == '1990' ? 'selected' : '' }}>1990</option>
                                    <option value="1991" {{ old('ano_da_maquina') == '1991' ? 'selected' : '' }}>1991</option>
                                    <option value="1992" {{ old('ano_da_maquina') == '1992' ? 'selected' : '' }}>1992</option>
                                    <option value="1993" {{ old('ano_da_maquina') == '1993' ? 'selected' : '' }}>1993</option>
                                    <option value="1994" {{ old('ano_da_maquina') == '1994' ? 'selected' : '' }}>1994</option>
                                    <option value="1995" {{ old('ano_da_maquina') == '1995' ? 'selected' : '' }}>1995</option>
                                    <option value="1996" {{ old('ano_da_maquina') == '1996' ? 'selected' : '' }}>1996</option>
                                    <option value="1997" {{ old('ano_da_maquina') == '1997' ? 'selected' : '' }}>1997</option>
                                    <option value="1998" {{ old('ano_da_maquina') == '1998' ? 'selected' : '' }}>1998</option>
                                    <option value="1999" {{ old('ano_da_maquina') == '1999' ? 'selected' : '' }}>1999</option>
                                    <option value="1987" {{ old('ano_da_maquina') == '1987' ? 'selected' : '' }}>1987</option>
                                    <option value="2000" {{ old('ano_da_maquina') == '2000' ? 'selected' : '' }}>2000</option>
                                    <option value="2001" {{ old('ano_da_maquina') == '2001' ? 'selected' : '' }}>2001</option>
                                    <option value="2002" {{ old('ano_da_maquina') == '2002' ? 'selected' : '' }}>2002</option>
                                    <option value="2003" {{ old('ano_da_maquina') == '2003' ? 'selected' : '' }}>2003</option>
                                    <option value="2004" {{ old('ano_da_maquina') == '2004' ? 'selected' : '' }}>2004</option>
                                    <option value="2005" {{ old('ano_da_maquina') == '2005' ? 'selected' : '' }}>2005</option>
                                    <option value="2006" {{ old('ano_da_maquina') == '2006' ? 'selected' : '' }}>2006</option>
                                    <option value="2007" {{ old('ano_da_maquina') == '2007' ? 'selected' : '' }}>2007</option>
                                    <option value="2008" {{ old('ano_da_maquina') == '2008' ? 'selected' : '' }}>2008</option>
                                    <option value="2009" {{ old('ano_da_maquina') == '2009' ? 'selected' : '' }}>2009</option>
                                    <option value="2010" {{ old('ano_da_maquina') == '2010' ? 'selected' : '' }}>2010</option>
                                    <option value="2011" {{ old('ano_da_maquina') == '2011' ? 'selected' : '' }}>2011</option>
                                    <option value="2012" {{ old('ano_da_maquina') == '2012' ? 'selected' : '' }}>2012</option>
                                    <option value="2013" {{ old('ano_da_maquina') == '2013' ? 'selected' : '' }}>2013</option>
                                    <option value="2014" {{ old('ano_da_maquina') == '2014' ? 'selected' : '' }}>2014</option>
                                    <option value="2015" {{ old('ano_da_maquina') == '2015' ? 'selected' : '' }}>2015</option>
                                    <option value="2016" {{ old('ano_da_maquina') == '2016' ? 'selected' : '' }}>2016</option>
                                    <option value="2017" {{ old('ano_da_maquina') == '2017' ? 'selected' : '' }}>2017</option>
                                    <option value="2018" {{ old('ano_da_maquina') == '2018' ? 'selected' : '' }}>2018</option>
                                    <option value="2019" {{ old('ano_da_maquina') == '2019' ? 'selected' : '' }}>2019</option>
                                    <option value="2020" {{ old('ano_da_maquina') == '2020' ? 'selected' : '' }}>2020</option>
                                    <option value="2021" {{ old('ano_da_maquina') == '2021' ? 'selected' : '' }}>2021</option>
                                    <option value="2022" {{ old('ano_da_maquina') == '2022' ? 'selected' : '' }}>2022</option>
                                    <option value="2023" {{ old('ano_da_maquina') == '2023' ? 'selected' : '' }}>2023</option>
                                    <option value="2024" {{ old('ano_da_maquina') == '2024' ? 'selected' : '' }}>2024</option>
                                </select>
                            </div>
                            <div class="col-md-8" id="nomeVeiculos">
                                <label class="form-label" for="veiculo">Veículo</label>
                                <input class="form-control" id="veiculo" name="veiculo" type="veiculo" value="{{ old('veiculo') }}" readonly placeholder="Preenchimento Automático">
                            </div>
                            <div class="col-md-8" id="nomeMaquinas">
                                <label class="form-label" for="veiculo_maquina">Modelo/Ano</label>
                                <input class="form-control" id="veiculo_maquina" name="veiculo_maquina" type="veiculo_maquina" value="{{ old('veiculo_maquina') }}" readonly placeholder="Preenchimento Automático">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="valor_fipe1">Valor</label>
                                <input class="form-control" id="valor_fipe1" name="valor_fipe" type="text" value="{{ old('valor_fipe') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="codigo_fipe">Código</label>
                                <input class="form-control" id="codigo_fipe" name="codigo_fipe" type="text" value="{{ old('codigo_fipe') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="fipe_mes_referencia">Mês de referência</label>
                                <input class="form-control" id="fipe_mes_referencia" name="fipe_mes_referencia" type="text" value="{{ old('fipe_mes_referencia') }}">
                            </div>
                        </div>

                        <div class="row mt-3" id="divPlacaRenavam" style="display:none;">
                            <div class="col-md-4">
                                <label class="form-label" for="placa">Placa</label>
                                <input class="form-control text-uppercase" id="placa" name="placa" type="text" value="{{ old('placa') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="renavam">Renavam</label>
                                <input class="form-control" id="renavam" name="renavam" type="text" value="{{ old('renavam') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem_atual">Quilometragem Inicial</label>
                                <input class="form-control" id="quilometragem_atual" name="quilometragem_atual" type="number" value="{{ old('quilometragem_atual') }}">
                            </div>
                        </div>

                        <div class="row mt-3" id="divHorimetro" style="display:none;">
                            <div class="col-md-2">
                                <label class="form-label" for="horimetro_inicial">Horímetro inicial</label>
                                <input class="form-control" id="horimetro_inicial" name="horimetro_inicial" type="text" value="{{ old('horimetro_inicial') }}" step="60">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="codigo_da_maquina">ID da Máquina</label>
                                <input class="form-control" id="codigo_da_maquina" name="codigo_da_maquina" type="text" value="{{ old('codigo_da_maquina') }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8">
                                <label class="form-label" for="observacao">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao" cols="30" rows="6">{{ old('observacao') }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label class="form-label" for="situacao">Situação</label>
                                <select class="form-select" id="situacao" name="situacao">
                                    <option value="Ativo">Ativo</option>
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
