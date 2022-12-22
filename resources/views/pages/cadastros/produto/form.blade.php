@extends('dashboard')
@section('title', 'Produto')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Cadastro de Produto
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

                @php $action = isset($store) ? url('cadastro/produto/update/'.$store->id) : url('cadastro/produto/store'); @endphp
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf

                    <div class="col-md-12">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" value="{{ old('titulo', @$store->titulo) }}" name="titulo">
                    </div>

                    <div class="col-md-12">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control summernote">{{ old('descricao', @$store->descricao) }}</textarea>

                    </div>                    

                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="Ativo" @php if(@$store->status=="Ativo") echo 'selected' @endphp>Ativo</option>
                            <option value="Inativo" @php if(@$store->status=="Inativo") echo 'selected' @endphp>Inativo</option>
                        </select>
                    </div>    

                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium">Salvar</button>

                        <a href="{{ route('cadastro.produto') }}">
                            <button type="button" class="btn btn-block btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection