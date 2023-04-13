@extends('dashboard')
@section('title', 'Retirada de Ferramentas')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
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

                        @if(Auth::user()->user_level ==1)
                        <div class="row">
                            <div class="col-12">
                                @include('components.fields.id_obra')
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->user_level >= 2)
                            <input type="hidden" name="id_obra" id="id_obra" value="">
                        @endif

                        <div class="row mt-3">
                            <div class="col-6">
                                @include('components.fields.id_funcionario')
                            </div>

                            <div class="col-3">
                                <label for="data_solicitacao" class="form-label">Data de Solicitação</label>
                                <input type="date" class="form-control"
                                    value="@php echo date("Y-m-d"); @endphp" disabled>
                            </div>

                            <div class="col-3">
                                <label for="devolucao_prevista" class="form-label">Devolução Prevista</label>
                                <input type="datetime-local" class="form-control" value="" name="devolucao_prevista"
                                    id="devolucao_prevista">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3">
                                <label for="data_solicitacao" class="form-label">Observações</label>
                                <textarea rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3">
                                <table class="table table-striped table-bordered table-hover">
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
                                                <td><span
                                                        class="badge badge-danger">{{ $est->codigo_obra . ' - ' . $est->razao_social }}</span>
                                                </td>
                                                <td>{{ $est->item }}</td>
                                                <td>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="id_ativo_exerno" name="id_ativo_externo[]"
                                                            value="{{ $est->id_ativo_externo_item }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                       
                            <button type="submit"
                                class="btn btn-gradient-primary font-weight-medium">Salvar</button>

                            <a href="{{ route('ferramental.retirada') }}">
                                <button type="button"
                                    class="btn btn-gradient-danger font-weight-medium">Cancelar</button>
                            </a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
