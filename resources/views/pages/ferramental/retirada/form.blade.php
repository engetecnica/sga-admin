@extends('dashboard')
@section('title', 'Retirada de Ferramentas')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Retirada de Ferramentas
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Ferramental <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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
                        $action = isset($store) ? route('ferramental.retirada.update', $store->id) : route('ferramental.retirada.store');
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf

                        @if (Auth::user()->user_level == 1)
                            <div class="row">
                                <div class="col-12">
                                    @include('components.fields.id_obra')
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->user_level >= 2)
                            <input id="id_obra" name="id_obra" type="hidden" value="">
                        @endif

                        <div class="row mt-3">
                            <div class="col-12">
                                @include('components.fields.id_obra')
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                @include('components.fields.id_funcionario')
                            </div>

                            <div class="col-3">
                                <label class="form-label" for="data_solicitacao">Data de Solicitação</label>
                                <input class="form-control" type="date" value="@php echo date("Y-m-d"); @endphp" disabled>
                            </div>

                            <div class="col-3">
                                <label class="form-label" for="devolucao_prevista">Devolução Prevista</label>
                                <input class="form-control" id="devolucao_prevista" name="devolucao_prevista" type="datetime-local" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3">
                                <label class="form-label" for="observacoes">Observações</label>
                                <textarea class="form-control" name="observacoes" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-5">
                                <table class="table-striped table-hover table" id="tabela">
                                    <thead>
                                        <tr class="">
                                            <th width="10%">Patrimônio</th>
                                            <th width="30%">Estoque na Obra</th>
                                            <th>Item</th>
                                            <th>Demarcar Item</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($estoque as $est)
                                            <tr>
                                                <td><span class="badge badge-primary">{{ $est->patrimonio }}</span></td>
                                                <td><span class="badge badge-danger">{{ $est->codigo_obra . ' - ' . $est->razao_social }}</span>
                                                </td>
                                                <td>{{ $est->item }}</td>
                                                <td>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" id="id_ativo_exerno" name="id_ativo_externo[]" type="checkbox" value="{{ $est->id_ativo_externo_item }}" role="switch">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <button class="btn btn-gradient-primary font-weight-medium" type="submit">Salvar</button>

                        <a href="{{ route('ferramental.retirada') }}">
                            <button class="btn btn-gradient-danger font-weight-medium" type="button">Cancelar</button>
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL INCLUSAO RAPIDA DE OBRAS --}}
    @include('pages.cadastros.obra.partials.inclusao-rapida')

@endsection
