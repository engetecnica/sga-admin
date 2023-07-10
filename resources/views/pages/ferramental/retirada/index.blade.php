@extends('dashboard')
@section('title', 'Retirada de Ferramentas')
@section('content')

{{-- @dd($retiradas) --}}

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary me-2 text-white">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Ferramental
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Retirada de Ferramentas <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('ferramental.retirada.adicionar') }}">
            <button class="btn btn-sm btn-danger">Nova Retirada</button>
        </a>
    </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <style>
                    .relacionamento {
                        pointer-events: none;
                        background-color: #eee;
                        opacity: 0.6;
                        /* Outros estilos para indicar visualmente que a linha está desativada */
                    }
                </style>
                <table class="table-hover table-striped table" id="tabela">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th> Obra </th>
                            <th> Solicitante </th>
                            <th> Funcionário </th>
                            <th> Data de Inclusão </th>
                            <th> Devolução Prevista </th>
                            <th> Status</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($retiradas as $retirada)
                        @php
                        $relacionado = collect($retiradas)->firstWhere('id_relacionamento', $retirada->id);
                        @endphp
                        <tr class="{{ $relacionado ? 'relacionamento' : '' }}">
                            <td class="align-middle" width="8%">{{ $retirada->id }} </td>
                            <td class="align-middle"><span class="badge badge-secondary">{{ $retirada->obra->codigo_obra }}</span></td>
                            <td class="align-middle">{{ $retirada->usuario->name }}</td>
                            <td class="align-middle">{{ $retirada->funcionario->nome }}</td>
                            <td class="align-middle">{{ Tratamento::datetimeBr($retirada->created_at) }}</td>
                            <td class="align-middle">{{ Tratamento::datetimeBr($retirada->data_devolucao_prevista) }}</td>
                            <td class="align-middle">
                                <span class="badge badge-{{ $retirada->situacao->classe }}">{{ $retirada->situacao->titulo }}</span>
                                <a href="javascript:void(0)">
                                    <button class="badge badge-info ItemsRetirada" id="" data-id_retirada="{{ $retirada->id }}" data-bs-toggle="modal" data-bs-target="#ItemsRetiradaModal">Itens</button>
                                </a>
                                <a href="{{ route('ferramental.retirada.detalhes', $retirada->id) }}"><span class="badge badge-success">{{ $retirada->id_relacionamento ? 'Prazo + #' . $retirada->id_relacionamento : '' }}</span></a>
                            </td>
                            <td width="10%">
                                <div class="dropdown">
                                    <button class="btn btn-gradient-danger btn-sm" id="dropdownMenuButton1" data-bs-toggle="dropdown" type="button" aria-expanded="false">
                                        Selecione <i class="mdi mdi-menu-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        @if ($retirada->status == '2' || ($retirada->status == '5' && $retirada->termo_responsabilidade_gerado))
                                        <li><a class="dropdown-item" href="{{ route('ferramental.retirada.devolver', $retirada->id) }}"><i class="mdi mdi-redo-variant"></i> Devolver Itens</a></li>
                                        @endif
                                        @if ($retirada->id_relacionamento == null && $retirada->status < 3) <li><a class="dropdown-item" href="{{ route('ferramental.retirada.ampliar', $retirada->id) }}"><i class="mdi mdi-calendar-plus"></i> Ampliar prazo</a></li>
                                            @endif
                                            @if ($retirada->status == '1' && !$retirada->termo_responsabilidade_gerado)
                                            <li><a class="dropdown-item" href="{{ route('ferramental.retirada.termo', $retirada->id) }}" target="_blank"><i class="mdi mdi-access-point-network"></i> Gerar Termo</a></li>
                                            @endif
                                            @if ($retirada->status == '2' or $retirada->status == '3' && $retirada->termo_responsabilidade_gerado)
                                            <li><a class="dropdown-item" href="{{ route('ferramental.retirada.termo', $retirada->id) }}"><i class="mdi mdi-download"></i> Baixar Termo</a></li>
                                            @endif
                                            @if ($retirada->status == '1' && !$retirada->termo_responsabilidade_gerado)
                                            <li><a class="dropdown-item" href="{{ route('ferramental.retirada.editar', $retirada->id) }}"><i class="mdi mdi-pencil"></i> Modificar Retirada</a></li>
                                            <li>
                                                <form action="{{ route('ferramental.retirada.destroy', $retirada->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="dropdown-item" type="submit" onclick="return confirm('Deseja realmente cancelar a retirada?')">
                                                        <i class="mdi mdi-cancel"></i> Cancelar Retirada
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            <li><a class="dropdown-item" href="{{ route('ferramental.retirada.detalhes', $retirada->id) }}"><i class="mdi mdi-minus"></i> Detalhes</a></li>
                                            @if ($retirada->status == '3' or $retirada->status == '4' && $retirada->termo_responsabilidade_gerado)
                                            <li><a class="dropdown-item" href="{{ route('ferramental.retirada.termo', $retirada->id) }}"><i class="mdi mdi-printer"></i> Ver Termo</a></li>
                                            @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ItemsRetiradaModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="ItemsRetiradaLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ItemsRetiradaLabel">Itens da Retirada </h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                items
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Fechar</button>
            </div>
        </div>
    </div>
</div>

@endsection