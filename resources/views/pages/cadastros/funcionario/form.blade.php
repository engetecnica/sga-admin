@extends('dashboard')
@section('title', 'funcionarioes')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Cadastro de funcionarioes
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
                    $action = isset($store) ? route('cadastro.funcionario.update', $store->id) : route('cadastro.funcionario.store');
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <label for="matricula" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" id="matricula"
                                    value="{{ old('matricula', @$store->matricula) ?? "SGAE-".date("YmI")  }}" name="matricula" readonly>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check margin-top-digitar-manualmente">
                                    <label class="form-check-label"> Digitar Manualmente
                                    <input class="checkbox digitar-manualmente" data-field="matricula" type="checkbox"> <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            @include('components.fields.id_obra')
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="razao_social"
                                    value="{{ old('nome', @$store->nome) }}" name="nome">
                            </div>
                            <div class="col-md-3">
                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nascimento"
                                    value="{{ old('data_nascimento', @$store->data_nascimento) }}" name="data_nascimento">
                            </div>
                            <div class="col-md-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control cpf" id="cpf"
                                    value="{{ old('cpf', @$store->cpf) }}" name="cpf">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="rg" class="form-label">Registro Geral (RG)</label>
                                <input type="text" class="form-control" id="rg"
                                    value="{{ old('rg', @$store->rg) }}" name="rg">
                            </div>
                            <div class="col-md-3">
                                <label for="celular" class="form-label">Celular / WhatsApp</label>
                                <input type="text" class="form-control celular" id="celular"
                                    value="{{ old('celular', @$store->celular) }}" name="celular">
                            </div>
                            <div class="col-md-6">
                                @include('components.fields.id_funcao')
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control cep" id="cep"
                                    value="{{ old('cep', @$store->cep) }}" name="cep">
                            </div>
                            <div class="col-md-4">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco"
                                    value="{{ old('endereco', @$store->endereco) }}" name="endereco">
                            </div>
                            <div class="col-md-2">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero"
                                    value="{{ old('numero', @$store->numero) }}" name="numero">
                            </div>
                            <div class="col-md-4">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro"
                                    value="{{ old('bairro', @$store->bairro) }}" name="bairro">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade"
                                    value="{{ old('cidade', @$store->cidade) }}" name="cidade">
                            </div>
                            <div class="col-md-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select name="estado" id="estado" class="form-select">
                                    <option value="">Selecione o Estado</option>
                                    @foreach ($estados as $sigla => $estado)
                                        <option value="{{ $sigla }}"
                                            @php if(@$store->estado==$sigla) echo 'selected' @endphp>{{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{ old('email', @$store->email) }}" name="email">
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

                        <div class="col-12 mt-5">
                            <button type="submit"
                                class="btn btn-block btn-gradient-primary btn-lg font-weight-medium">Salvar</button>

                            <a href="{{ route('cadastro.funcionario') }}">
                                <button type="button"
                                    class="btn btn-block btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
