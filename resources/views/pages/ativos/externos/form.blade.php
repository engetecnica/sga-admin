@extends('dashboard')
@section('title', 'Ativos Externos')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Incluir novo Ativo Externo
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Ativos <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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
                $action = isset($store) ? route('ativo.externo.update', $store->id) : route('ativo.externo.store');
                @endphp
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf

                    <div class="col-md-12">
                        <label for="id_ativo_configuracao" class="form-label">Categoria</label>
                        <select class="form-control select2" id="id_ativo_configuracao" name="id_ativo_configuracao">
                            <option value="">Selecione uma Categoria</option>
                            <?php foreach($ativo_configuracoes as $atv){ ?>
                                <option value="<?php echo $atv->id; ?>" @php if(old('id_ativo_configuracao', @$store->id_ativo_configuracao) == $atv->id) echo "selected"; @endphp <?php if(count($atv->subcategorias)>0){ ?>disabled style="background-color: #EDEDED !important"<?php } ?>><?php echo $atv->titulo; ?></option>
                                <?php if(count($atv->subcategorias)>0){ ?>
                                    <?php foreach($atv->subcategorias as $sub){ ?>
                                        <option value="<?php echo $sub->id;?>"><?php echo $sub->titulo; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        @include('components.fields.id_obra')
                    </div>

                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" value="{{ old('titulo', @$store->titulo) }}" name="titulo">
                    </div> 
                    
                    <div class="col-md-2">
                        <label for="status" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="1">
                    </div>

                    <div class="col-md-2">
                        <label for="status" class="form-label">Valor</label>
                        <input type="text" class="form-control money" id="valor" name="valor" value="0.00">
                    </div>

                    <div class="col-md-2">
                        <label for="calibracao" class="form-label">Precisa Calibrar?</label>
                        <select class="form-select" name="calibracao" id="calibracao">
                            <option value="1">Sim</option>
                            <option value="0" selected>Não</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="Ativo">Em Estoque</option>
                        </select>
                    </div>

                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-gradient-dark btn-lg font-weight-medium">Gravar novos Ativos</button>
                        <a href="{{ route('ativo.externo') }}">
                            <button type="button" class="btn btn-block btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection