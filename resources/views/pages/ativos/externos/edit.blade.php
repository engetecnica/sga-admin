@extends('dashboard')
@section('title', 'Ativos Externos')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Editar Ativo Externo
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Ativos <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    @foreach ($estoques as $estoque)
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
                        <form method="post" action="{{ route('ativo.externo.update', $estoque->ativo_externo->id) }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Categoria</label>
                                    <select class="form-select select2" name="id_ativo_configuracao">
                                        <option value="">Selecione uma Categoria</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $estoque->ativo_externo->id_ativo_configuracao == $categoria->id ? 'selected' : '' }}>{{ $categoria->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label">Obra</label> <button class="badge badge-primary" data-toggle="modal" data-target="#modal-add" type="button"><i class="mdi mdi-plus"></i></button>
                                    <select class="form-select select2" name="id_obra">
                                        <option value="">Selecione uma Obra</option>

                                        @foreach ($obras as $obra)
                                            <option value="{{ $obra->id }}" {{ $estoque->obra->id == $obra->id ? 'selected' : '' }}>
                                                {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="status">Situação</label>
                                    <select class="form-select select2" name="status">
                                        @foreach ($situacoes as $situacao)
                                            <option value="{{ $situacao->id }}" {{ $estoque->status == $situacao->id ? 'selected' : '' }}>{{ $situacao->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <label class="form-label" for="patrimonio">Patrimônio</label>
                                    <input class="form-control" id="patrimonio" name="patrimonio" type="text" value="{{ $estoque->patrimonio ?? old('patrimonio') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="titulo">Título</label>
                                    <input class="form-control" id="titulo" name="titulo" type="text" value="{{ $estoque->ativo_externo->titulo ?? old('titulo') }}">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label" for="status">Valor</label>
                                    <input class="form-control money" id="valor" name="valor" type="text" value="{{ $estoque->valor ?? old('valor') }}">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label" for="calibracao">Precisa Calibrar?</label>
                                    <select class="form-select select2" id="calibracao" name="calibracao">
                                        <option value="1">Sim</option>
                                        <option value="0" {{ $estoque->calibracao == 0 ? 'selected' : '' }}>Não</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-select select2" id="status" name="status">
                                        <option value="Ativo" selected>Em Estoque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-gradient-dark btn-lg font-weight-medium" type="submit">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- MODAL INCLUSAO RAPIDA DE OBRAS --}}
    @include('pages.cadastros.obra.partials.inclusao-rapida')
@endsection
