@extends('dashboard')
@section('title', 'Mensagens')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Mensagens
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Envio de Mensagem <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('ferramenta.mensagem.adicionar') }}">
            <button class="btn btn-sm btn-danger">Novo Envio</button>
        </a>
    </h3>
</div>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <table class="table table-hover table-striped" id="lista-simples">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th>Tipo</th>
                            <th>Título</th>
                            <th>Data</th>
                            <th>Empresa</th>
                            <th>Cliente</th>
                            <th>Telefone</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($lista as $mensagem) { ?>
                            <tr>
                                <td>{{ $mensagem->id }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $mensagem->tipo }}</span>
                                </td>
                                <td>{{ $mensagem->titulo }}</td>
                                <td>{{ Tratamento::FormatarData($mensagem->created_at) }}</td>
                                <td>{{ $mensagem->empresa_nome }}</td>
                                <td>{{ $mensagem->cliente_nome }}</td>
                                <td>
                                    <a href="{{ Tratamento::SetURLWhatsApp($mensagem->celular) }}">
                                        <button class="badge badge-primary">
                                            <span class="mdi mdi-whatsapp"></span> {{ $mensagem->celular }}
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge badge-success">{{ $mensagem->status }}</span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

@endsection