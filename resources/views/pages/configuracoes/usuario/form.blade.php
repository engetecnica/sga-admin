@extends('dashboard')
@section('title', 'Usuário')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Usuário
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Configurações <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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

                @php $action = isset($store) ? route('usuario.update', $store->id) : route('usuario.store'); @endphp
                <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf



                    @if(Session::get('usuario_vinculo')['id_nivel'] == 2)
                    <div class="row mt-3">
                        @include('components.fields.id_funcionario')
                    </div>
                    @endif


                    @if(Session::get('usuario_vinculo')['id_nivel'] == 1)
                    <div class="row">
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" value="{{ old('nome', @$store->name) }}" name="nome" focus>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail / Usuário</label>
                            <input type="email" class="form-control" id="email" value="{{ old('email', @$store->email) }}" name="email">
                        </div>
                        <div class="col-md-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-3">
                            <label for="password_confirm" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                        </div>
                    </div>





                    @if(Session::get('usuario_vinculo')['id_nivel'] == 2)
                    <div class="row mt-3">
                        @include('components.fields.id_obra')
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="nivel" class="form-label">Tipo de Usuário</label>
                            <select class="form-select" id="nivel" name="nivel">
                                <option value="">Escolha o Tipo de Usuário</option>
                                @foreach($usuario_niveis as $nivel)
                                <option value="{{ $nivel->id }}" @php if(old('nivel', @$store->user_level) == $nivel->id) echo "selected"; @endphp >{{ $nivel->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="Ativo" @php if(@$store->status=="Ativo") echo 'selected' @endphp>Ativo
                                </option>
                                <option value="Inativo" @php if(@$store->status=="Inativo") echo 'selected' @endphp>
                                    Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-gradient-primary btn-lg font-weight-medium">Salvar</button>

                        <a href="{{ route('usuario') }}">
                            <button type="button" class="btn btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection