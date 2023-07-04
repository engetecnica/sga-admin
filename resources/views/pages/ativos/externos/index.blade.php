@extends('dashboard')
@section('title', 'Ativos Externos')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary me-2 text-white">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Ativos Externos
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Ativos <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('ativo.externo.adicionar') }}">
            <button class="btn btn-sm btn-danger">Inclusão de Novos Ativos</button>
        </a>
    </h3>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table-hover table-striped table pt-4" id="tabela-estoque-lista">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th>Obra</th>
                            <th>Patrimônio</th>
                            <th>Título</th>
                            <th>Valor</th>
                            <th>Calibração</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ativos_estoque as $estoque)
                        <tr>
                            <td><b>{{ $estoque->id }}</b></td>
                            <td><span class="badge badge-warning">{{ $estoque->obra->codigo_obra }}</span></td>
                            <td><span class="badge badge-danger">{{ $estoque->patrimonio }}</span></td>
                            <td>{{ $estoque->configuracao->titulo }}</td>
                            <td>R$ {{ Tratamento::currencyFormatBr($estoque->valor) }}</td>
                            <td>
                                @if($estoque->calibracao==1)
                                <span class="badge badge-primary">Sim</span>
                                @endif

                                @if($estoque->calibracao==0)
                                <span class="badge badge-secondary">Não</span>
                                @endif
                            </td>
                            <td><span class="badge badge-{{ $estoque->situacao->classe }}">{{ $estoque->situacao->titulo }}</span></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table-hover table-striped table pt-4" id="tabela">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th>Categoria</th>
                            <th>Título</th>
                            <th>Data de Inclusão</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ativos as $ativo)
                        <tr>
                            <td>{{ $ativo->id }}</td>
                            <td>{{ $ativo->configuracao->titulo ?? '-' }}</td>
                            <td>{{ $ativo->titulo }}</td>
                            <td>{{ Tratamento::datetimeBr($ativo->created_at) }}</td>
                            <td>{{ $ativo->status }}</td>
                            <td>
                                <a class="badge badge-primary" href="{{ route('ativo.externo.editar', $ativo->id) }}">Editar</a>
                                <a class="badge badge-success" href="{{ route('ativo.externo.detalhes', $ativo->id) }}">Detalhes</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection