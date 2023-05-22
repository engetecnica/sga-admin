@extends('dashboard')
@section('title', 'Requisições')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Ferramental
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('ferramental.requisicao.index') }}">
                        <button class="btn btn-sm btn-danger">Todos</button>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            Detalhes da Requisição
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table-striped table">
                        <tr>
                            <th>ID Requisição</th>
                            <th>Solicitação</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>{{ $ferramentalRequisicao->id }}</td>
                            <td>{{ Tratamento::datetimeBR($ferramentalRequisicao->created_at) }}</td>
                            <td><span class="badge badge-{{ $ferramentalRequisicao->situacao->classe }}">{{ $ferramentalRequisicao->situacao->titulo }}</span></td>
                        </tr>
                    </table>

                    <table class="table-striped mt-5 table">
                        <tr>
                            <th>Despachante</th>
                            <th>Origem</th>
                            <th>Solicitante</th>
                            <th>Destino</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{{ $ferramentalRequisicao->obraOrigem->razao_social }}</td>
                            <td>{{ $ferramentalRequisicao->solicitante->name }}</td>
                            <td>{{ $ferramentalRequisicao->obraDestino->razao_social }}</td>
                        </tr>
                    </table>

                    <table class="table-striped mt-5 table">
                        <tr>
                            <th>Solicitado</th>
                            <th>Liberado</th>
                            <th>Transferido</th>
                            <th>Recebido</th>
                        </tr>
                        <tr>
                            <td>{{ Tratamento::datetimeBR($ferramentalRequisicao->created_at) }}</td>
                            <td>{{ Tratamento::datetimeBR($ferramentalRequisicao->data_liberacao) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="table-striped mt-5 table">
                        <tr>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Estoque</th>
                            <th>Qtde. Solicitada</th>
                            <th>Qtde. Liberada</th>
                            <th>Liberar</th>
                            <th>Situação</th>
                            <th>Opções</th>
                        </tr>

                        @foreach ($itens as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->ativo->titulo }}</td>
                                <td></td>
                                <td>{{ $item->quantidade_solicitada }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
