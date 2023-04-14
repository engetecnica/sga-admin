@extends('dashboard')
@section('title', 'Retirada - Detalhes')
@section('content')


    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Detalhes da Retirada
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Ferramental <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            <a href="{{ route('ferramental.retirada.adicionar') }}">
                <button class="btn btn-sm btn-danger">Nova Retirada</button>
            </a>

            <a href="{{ route('ferramental.retirada') }}">
                <button class="btn btn-sm btn-light">Listar Todas </button>
            </a>
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">                             
                                
                                <button type="button" class="btn btn-outline-warning btn-fw">
                                    RETIRADA <span class="mdi mdi-pound"></span>{{ $detalhes->id }}
                                </button>                               

                                <hr>

                                <div class="mb-3 mt-3 btn-align-float">
                                    <button type="button" class="btn btn-{{ Tratamento::getStatusRetirada($detalhes->status)['classe'] }} btn-fw">
                                        <span class="mdi mdi-check-all"></span> {{ Tratamento::getStatusRetirada($detalhes->status)['titulo'] }}
                                    </button>
                                </div>

                                @if($detalhes->status==1 && !$detalhes->termo_responsabilidade_gerado)
                                    <div class="mb-3 mt-3 btn-align-float">
                                        <a href="javascript:void(0)">
                                            <button class="btn btn-warning" id="gerar_termo"
                                                data-id_retirada="{{ $detalhes->id }}" data-bs-toggle="modal"
                                                data-bs-target="#gerarTermoModal">
                                                <span class="mdi mdi-access-point-network"></span> Gerar Termo
                                            </button>
                                        </a>
                                    </div>
                                @endif

                                @if($detalhes->status==1 && $detalhes->termo_responsabilidade_gerado && empty($detalhes->anexo))
                                <div class="mb-3 mt-3 btn-align-float">
                                    <a href="javascript:void(0)" id="enviar_anexo"
                                                data-id_retirada="{{ $detalhes->id }}" data-bs-toggle="modal"
                                                data-bs-target="#anexarArquivo">
                                        <button class="btn btn-info">
                                            <span class="mdi mdi-file-send"></span> Enviar Anexo
                                        </button>
                                    </a>
                                </div>
                                @endif

                                @if(!empty($detalhes->anexo))
                                <div class="mb-3 mt-3 btn-align-float">
                                    <a href="{{ route('ferramental.retirada.download', $detalhes->id) }}">
                                        <button class="btn btn-secondary">
                                            <span class="mdi mdi-download"></span> Baixar Termo
                                        </button>
                                    </a>
                                </div>
                                @endif

                                <table class="table table-bordered table-striped table-houver">
                                    <thead>
                                        <tr>
                                            <th> Obra </th>
                                            <th> Solicitante </th>
                                            <th> Funcionário </th>
                                            <th> Item </th>
                                            <th> Data de Inclusão </th>
                                            <th> Devolução Prevista </th>
                                            <th> Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalhes->itens as $item)
                                            <tr>
                                                <td>{{ $detalhes->codigo_obra . ' - ' . $detalhes->razao_social }}</td>
                                                <td>{{ $detalhes->name }}</td>
                                                <td>{{ $detalhes->funcionario }}</td>
                                                <td>
                                                    <div class="badge badge-danger">{{ $item->item_codigo_patrimonio }}
                                                    </div>
                                                    <div class="badge badge-info">{{ $item->item_nome }}</div>
                                                </td>
                                                <td>{{ Tratamento::FormatarData($detalhes->created_at) }}</td>
                                                <td>{{ Tratamento::FormatarData($detalhes->data_devolucao_prevista) }}</td>
                                                <td>
                                                    <div class="badge badge-{{ Tratamento::getStatusRetirada($item->status)['classe'] }}">
                                                        {{ Tratamento::getStatusRetirada($item->status)['titulo'] }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                @if(!empty($detalhes->anexo))
                                <hr>
                                <h3>Anexos</h3>
                                <table class="table table-bordered table-striped table-houver">
                                    <thead>
                                        <tr>
                                            <th> Tipo </th>
                                            <th> Título </th>
                                            <th> Descrição </th>
                                            <th> Data de Inclusão </th>
                                            <th> Visualizar Arquivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Termo de Responsabilidade - {{ $detalhes->anexo->tipo }}</td>
                                            <td>{{ $detalhes->anexo->titulo }}</td>
                                            <td>{{ $detalhes->anexo->descricao }}</td>
                                            <td>{{ Tratamento::FormatarData($detalhes->anexo->created_at) }}</td>
                                            <td><button class="btn btn-danger btn-sm">Baixar Arquivo</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- Modal -->
<div class="modal fade" id="gerarTermoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="gerarTermoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gerarTermoLabel">Assinar Termo de Retirada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('components.termo.termo_retirada_digital')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning retirada-assinar-termo" data-tipo="manual" >Assinatura Manual</button>
                {{-- <button type="button" class="btn btn-primary retirada-assinar-termo" data-tipo="digital">Assinatura Digital</button> --}}
            </div>
        </div>
    </div>
</div>

@include('components.anexo.form', 
            [
                'path' => 'termos_retirada', 
                'id_item' => $detalhes->id,
                'id_modulo' => 18
            ]
        )