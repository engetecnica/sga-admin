@extends('dashboard')
@section('title', 'Retirada - Devolução')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Devolução de Itens
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
                            <form name="devolverItem" action="{{ route('ferramental.retirada.devolver.salvar') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <a class="btn btn-outline-warning btn-fw" type="button" href="{{ route('ferramental.retirada.detalhes', $detalhes->id) }}">
                                        RETIRADA <span class="mdi mdi-pound"></span>{{ $detalhes->id }}
                                    </a>
                                    <hr>
                                    <table class="table-bordered table-striped table-houver table">
                                        <thead>
                                            <tr>
                                                <th> Obra </th>
                                                <th> Solicitante </th>
                                                <th> Funcionário </th>
                                                <th> Item </th>
                                                <th> Solicitado </th>
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

                                                    <td>
                                                        <select class="form-select-sm" id="id_ativo_externo" name="id_ativo_externo[{{ $item->id }}]" {{ $item->status == 2 || $item->status == 5 ? '' : 'disabled' }}>
                                                            <option value="{{ $item->status }}">{{ Tratamento::getStatusRetirada($item->status)['titulo'] }}</option>
                                                            <option value="3">Devolvido</option>
                                                            <option value="4">Devolvido com Defeito</option>
                                                            <option value="5">Não Devolvido</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                    <label class="form-label" for="observacoes">Observações</label>
                                                    <textarea class="form-control" id="observacoes" name="observacoes" rows="3" {{ $item->status == 2 || $item->status == 5 ? '' : 'disabled' }}>{{ $detalhes->devolucao_observacoes }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    @if ($detalhes->status == 2 || $detalhes->status == 5)
                                        <div class="mt-2">
                                            <button class="btn btn-gradient-primary font-weight-medium" type="submit">Devolver Itens</button>

                                            <a href="{{ route('ferramental.retirada') }}">
                                                <button class="btn btn-gradient-danger font-weight-medium" type="button">Cancelar</button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
