@extends('dashboard')
@section('title', 'Ativos Internos')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Editar Ativo Interno
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="btn btn-success" href="{{ route('ativo.interno.index', $ativo->id) }}">
                        <i class="mdi mdi-arrow-left icon-sm align-middle text-white"></i> Voltar
                    </a>
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

                    <form method="post" action="{{ route('ativo.interno.update', $ativo->id) }}">
                        @csrf

                        @method('put')

                        @include('pages.ativos.internos.partials.form')

                        <div class="col-12 mt-5">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium" type="submit">Salvar</button>

                            <a href="{{ route('ativo.interno.index') }}">
                                <button class="btn btn-gradient-danger btn-lg font-weight-medium" type="button">Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-5 flex-row">
                        <h3>Anexos</h3>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-file" type="button"><i class="mdi mdi-plus"></i> Adicionar anexo</button>
                    </div>
                    <table class="table-hover table-striped table">
                        <thead>
                            <tr>
                                <th>Anexo</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anexos as $anexo)
                                <tr>
                                    <td class="align-middle">{{ $anexo->arquivo }}</td>
                                    <td class="align-middle">{{ $anexo->titulo }}</td>
                                    <td class="align-middle">{{ $anexo->descricao }}</td>
                                    <td class="align-middle">{{ $anexo->tipo }}</td>
                                    <td class="align-middle">{{ Tratamento::datetimeBr($anexo->created_at) }}</td>
                                    <td class="d-flex gap-2 align-middle">
                                        <a class="btn btn-primary" href="{{ url('uploads/anexos/' . $anexo->arquivo) }}" target="_blank">Baixar</a>
                                        {{-- <form action="{{ route('ativo.interno.destroy', $anexo->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir">
                                                <i class="mdi mdi-delete"></i> Excluir
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL MARCAS CONFIRMATION --}}
    @include('pages.ativos.internos.partials.form-marcas')

    {{-- MODAL ANEXOS CONFIRMATION --}}
    @include('pages.ativos.internos.partials.form-anexos')

    {{-- MODAL INCLUSAO RAPIDA DE OBRAS --}}
    @include('pages.cadastros.obra.partials.inclusao-rapida')

@endsection
