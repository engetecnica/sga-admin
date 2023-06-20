@extends('dashboard')
@section('title', 'Funcionários')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Cadastro de funcionários
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
                                <label class="form-label" for="matricula">Matrícula</label>
                                <input class="form-control" id="matricula" name="matricula" type="text" value="{{ old('matricula', @$store->matricula) ?? 'SGAE-' . date('YmI') }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check margin-top-digitar-manualmente">
                                    <label class="form-check-label"> Digitar Manualmente
                                        <input class="checkbox digitar-manualmente" data-field="matricula" type="checkbox"> <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label" for="id_obra">Obra </label> <a class="badge badge-success ml-3 text-white" data-toggle="modal" data-target="#modal-add" style="cursor: pointer;">Inclusão rápida de Obra</a>
                                <select class="form-select select2" id="id_obra" name="id_obra" required>
                                    <option value="">Selecione uma Obra</option>
                                    @if (url()->current() == route('cadastro.funcionario.adicionar'))
                                        @foreach ($obras as $obra)
                                            <option value="{{ $obra->id }}" {{ old('id_obra') == $obra->id ? 'selected' : '' }}>
                                                {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($obras as $obra)
                                            <option value="{{ $obra->id }}" {{ $store->id_obra == $obra->id ? 'selected' : '' }}>
                                                {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
                                            </option>
                                        @endforeach

                                    @endif

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="id_funcao">Função</label> <a class="badge badge-success ml-3 text-white" data-toggle="modal" data-target="#modal-funcao" style="cursor: pointer;">Inclusão rápida de Função</a>
                                <select class="form-select select2" id="id_funcao" name="id_funcao" required>
                                    <option value="">Selecione uma Função</option>
                                    @if (url()->current() == route('cadastro.funcionario.adicionar'))
                                        @foreach ($funcoes as $funcao)
                                            <option value="{{ $funcao->id }}" {{ old('id_funcao') == $funcao->id ? 'selected' : '' }}>
                                                {{ $funcao->codigo }} - {{ $funcao->funcao }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($funcoes as $funcao)
                                            <option value="{{ $funcao->id }}" {{ $store->id_funcao == $funcao->id ? 'selected' : '' }}>
                                                {{ $funcao->codigo }} - {{ $funcao->funcao }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <h4 class="mb-3">Dados pessoais</h4>
                            <div class="col-md-6">
                                <label class="form-label" for="nome">Nome Completo</label>
                                <input class="form-control" id="razao_social" name="nome" type="text" value="{{ old('nome', @$store->nome) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="data_nascimento">Data de Nascimento</label>
                                <input class="form-control" id="data_nascimento" name="data_nascimento" type="date" value="{{ old('data_nascimento', @$store->data_nascimento) }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="form-label" for="rg">Registro Geral (RG)</label>
                                <input class="form-control" id="rg" name="rg" type="text" value="{{ old('rg', @$store->rg) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="cpf">CPF</label>
                                <input class="form-control cpf" id="cpf" name="cpf" type="text" value="{{ old('cpf', @$store->cpf) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="email">E-mail</label>
                                <input class="form-control" id="email" name="email" type="email" value="{{ old('email', @$store->email) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="celular">Celular / WhatsApp</label>
                                <input class="form-control celular" id="celular" name="celular" type="text" value="{{ old('celular', @$store->celular) }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <h4 class="mb-3">Endereço</h4>
                            <div class="col-md-2">
                                <label class="form-label" for="cep">CEP</label>
                                <input class="form-control cep" id="cep" name="cep" type="text" value="{{ old('cep', @$store->cep) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="endereco">Endereço</label>
                                <input class="form-control" id="endereco" name="endereco" type="text" value="{{ old('endereco', @$store->endereco) }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="numero">Número</label>
                                <input class="form-control" id="numero" name="numero" type="text" value="{{ old('numero', @$store->numero) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="bairro">Bairro</label>
                                <input class="form-control" id="bairro" name="bairro" type="text" value="{{ old('bairro', @$store->bairro) }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="form-label" for="cidade">Cidade</label>
                                <input class="form-control" id="cidade" name="cidade" type="text" value="{{ old('cidade', @$store->cidade) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="estado">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Selecione o Estado</option>
                                    @if (url()->current() == route('cadastro.funcionario.adicionar'))
                                        @foreach ($estados as $sigla => $estado)
                                            <option value="{{ $sigla }}" {{ old('estado') == $sigla ? 'selected' : '' }}>{{ $estado }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($estados as $sigla => $estado)
                                            <option value="{{ $sigla }}" @php if(@$store->estado==$sigla) echo 'selected' @endphp>{{ $estado }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Ativo" @php if(@$store->status=="Ativo") echo 'selected' @endphp>Ativo
                                    </option>
                                    <option value="Inativo" @php if(@$store->status=="Inativo") echo 'selected' @endphp>
                                        Inativo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium" type="submit">Salvar</button>

                            <a href="{{ route('cadastro.funcionario') }}">
                                <button class="btn btn-gradient-danger btn-lg font-weight-medium" type="button">Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('pages.cadastros.obra.partials.inclusao-rapida')

    @include('pages.cadastros.funcionario.funcoes.partials.inclusao-rapida')
@endsection
