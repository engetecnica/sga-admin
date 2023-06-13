@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Editar Veículo
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

                    <form method="post" action="{{ route('ativo.veiculo.update', $veiculo->id) }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-10">
                                <label class="form-label" for="obra">Obra</label> <button class="badge badge-primary" data-toggle="modal" data-target="#modal-add" type="button"><i class="mdi mdi-plus"></i></button>
                                <select class="form-select" id="obra" name="obra" required>
                                    @foreach ($obras as $obra)
                                        <option value="{{ $obra->id }}" {{ $veiculo->obra_id == $obra->id ? 'selected' : '' }}>{{ $obra->codigo_obra }} | {{ $obra->razao_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-5">
                                <label class="form-label" for="periodo_inicial">Período do Veículo Alocado - Inicial</label>
                                <input class="form-control" id="periodo_inicial" name="periodo_inicial" type="date" value="{{ old('periodo_inicial', $veiculo->periodo_inicial) }}">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" for="periodo_final">Período do Veículo Alocado - Final</label>
                                <input class="form-control" id="periodo_final" name="periodo_final" type="date" value="{{ old('periodo_final', $veiculo->periodo_final) }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="tipo">Tipo</label>
                                <select class="form-select" id="tipo" name="tipo" onchange="mostrarEsconderInputs()">
                                    <option value="motos" {{ $veiculo->tipo == 'motos' ? 'selected' : '' }}>Moto</option>
                                    <option value="carros" {{ $veiculo->tipo == 'carros' ? 'selected' : '' }}>Carro</option>
                                    <option value="caminhoes" {{ $veiculo->tipo == 'caminhoes' ? 'selected' : '' }}>Caminhão</option>
                                    <option value="">Redefinir valores</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="marcaVeiculos">
                                <label class="form-label" for="marca">Marca</label>
                                <select class="form-select" id="marca" name="marca">
                                    <option value="{{ $veiculo->marca }}" selected>{{ $veiculo->marca }}</option>
                                    <option value="">Redefinir valores</option>
                                </select>
                                <input id="marca_nome" name="marca_nome" type="hidden">
                            </div>
                            <div class="col-md-4" id="modeloVeiculos">
                                <label class="form-label" for="modelo">Modelo</label>
                                <select class="form-select" id="modelo" name="modelo">
                                    <option value="{{ $veiculo->modelo }}" selected>{{ $veiculo->modelo }}</option>
                                    <option value="">Redefinir valores</option>
                                </select>
                                <input id="modelo_nome" name="modelo_nome" type="hidden">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4" id="anoVeiculos">
                                <label class="form-label" for="ano">Ano</label>
                                <select class="form-select" id="ano" name="ano">
                                    <option value="{{ $veiculo->ano }}" selected>{{ $veiculo->ano }}</option>
                                </select>
                            </div>
                            <div class="col-md-8" id="nomeVeiculos">
                                <label class="form-label" for="veiculo">Veículo</label>
                                <input class="form-control" id="veiculo" name="veiculo" type="veiculo" value="{{ old('veiculo', $veiculo->veiculo) }}" readonly placeholder="Preenchimento Automático">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="valor_fipe1">Valor</label>
                                <input class="form-control" id="valor_fipe1" name="valor_fipe" type="text" value="{{ old('valor_fipe', $veiculo->valor_fipe) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="codigo_fipe">Código</label>
                                <input class="form-control" id="codigo_fipe" name="codigo_fipe" type="text" value="{{ old('codigo_fipe', $veiculo->codigo_fipe) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="fipe_mes_referencia">Mês de referência</label>
                                <input class="form-control" id="fipe_mes_referencia" name="fipe_mes_referencia" type="text" value="{{ old('fipe_mes_referencia', $veiculo->fipe_mes_referencia) }}">
                            </div>
                        </div>

                        <div class="row mt-3" id="divPlacaRenavam">
                            <div class="col-md-4">
                                <label class="form-label" for="placa">Placa</label>
                                <input class="form-control text-uppercase" id="placa" name="placa" type="text" value="{{ $veiculo->placa ?? old('placa') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="renavam">Renavam</label>
                                <input class="form-control" id="renavam" name="renavam" type="text" value="{{ old('renavam', $veiculo->renavam) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem_inicial">
                                    Quilometragem Inicial
                                </label>
                                <input class="form-control" id="quilometragem_atual" name="quilometragem_inicial" type="number" value="{{ old('quilometragem_inicial', $veiculo->quilometragem_inicial) }}">
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8">
                                <label class="form-label" for="observacao">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao" cols="30" rows="6">{{ $veiculo->observacao }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label class="form-label" for="situacao">Situação</label>
                                <select class="form-select" id="situacao" name="situacao">
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo" {{ $veiculo->situacao == 'Inativo' ? 'selected' : '' }}>Inativo</option>
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
                $('#marca').empty().append('<option value="" selected>Selecione o tipo</option>');
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
