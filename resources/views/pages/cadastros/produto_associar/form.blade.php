@extends('dashboard')
@section('title', 'Produto - Vincular Empresa')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Víncular Produto à Empresa Líder
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

                @php $action = isset($store) ? url('cadastro/produto/associar/update/'.$store->id) : url('cadastro/produto/associar/store'); @endphp
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf

                    <div class="col-md-12">
                        <label for="id_empresa" class="form-label">Empresa / Líder</label>
                        <select class="form-select select2" id="id_empresa" name="id_empresa">
                            <option>Empresa Líder</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nome }} - {{ $empresa->cpf }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label for="id_produto" class="form-label">Produto</label>
                        <select class="form-select select2" id="id_produto" name="id_produto" disabled>
                            <option>Produto / Ítem</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->titulo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="valor_compra">Valor de Compra</label>
                        <input type="text" class="form-control money" name="valor_compra" id="valor_compra" disabled>
                    </div>

                    <!-- 
                    Não existe taxa de risco, seria somente no processo de VENDA
                    <div class="col-md-2">
                        <label class="form-label" for="taxa_risco">Taxa de Risco</label>
                        <input type="text" class="form-control money" name="taxa_risco" id="taxa_risco" disabled>
                    </div> -->

                    <div class="col-md-2">
                        <label class="form-label" for="valor_venda">Valor de Venda</label>
                        <input type="text" class="form-control money" name="valor_venda" id="valor_venda" disabled>
                    </div>
                    

                    <div class="col-md-2">
                        <label class="form-label" for="lucro_obtido">Lucro Obtido</label>
                        <input type="text" class="form-control money" name="lucro_obtido" id="lucro_obtido" disabled>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label" for="image">Imagem</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    <div class="col-md-12">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="Ativo" @php if(@$store->status=="Ativo") echo 'selected' @endphp>Ativo</option>
                            <option value="Inativo" @php if(@$store->status=="Inativo") echo 'selected' @endphp>Inativo</option>
                        </select>
                    </div>    

                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium btn-salvar" disabled>Salvar</button>

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

