@extends('dashboard')
@section('title', 'Ativos Externos - Detalhes')
@section('content')


    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Detalhes do Ativo Externo
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

            <a href="{{ route('ativo.externo') }}">
                <button class="btn btn-sm btn-light">Listar Todos Ativos</button>
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
                                <h4 class="card-title">Ativo Externo - Detalhes</h4>
                                </p>
                                <table class="table table-bordered table-striped table-houver">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Categoria </th>
                                            <th> Item </th>
                                            <th> Data de Inclusão </th>
                                            <th> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $detalhes['id']; ?></td>
                                            <td><?php echo $detalhes['id_ativo_configuracao']; ?></td>
                                            <td><?php echo $detalhes['titulo']; ?></td>
                                            <td><?php echo date('d/m/Y H:i:s', strtotime($detalhes['created_at'])); ?> </td>
                                            <td>
                                                <div class="badge badge-warning"><?php echo $detalhes['status']; ?></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>




                            </div>
<div class="card-body">
                                <h4 class="card-title">Ativo Externo - Detalhes</h4>
                                </p>
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Patrimônio</th>
                                            <th scope="col">Obra Atual</th>
                                            <th scope="col">Valor do Item</th>
                                            <th scope="col">Calibração?</th>
                                            <th scope="col">Data de Descarte</th>
                                            <th scope="col">Data de Inclusão</th>
                                            <th scope="col">Situação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($ativos as $atv){ ?>
                                        <tr>
                                            <th scope="row"><?php echo $atv->id; ?></th>
                                            <td>
                                                <div class="badge badge-danger">
                                                    <i class="mdi mdi-wrench ml-2"></i> <?php echo $atv->patrimonio; ?>
                                                </div>
                                            </td>
                                            <td><?php echo $atv->razao_social; ?> - <?php echo $atv->cnpj; ?></td>
                                            
                                            <td>R$ <?php echo number_format($atv->valor, 2, ',', '.'); ?></td>
                                            <td><?php echo $atv->calibracao=='1' ? 'SIM' : 'NÃO' ?></td>
                                            <td><?php echo ($atv->data_descarte) ? Tratamento::FormatarData($atv->data_descarte) : '-'; ?></td>
                                            <td><?php echo Tratamento::FormatarData($atv->created_at); ?></td>
                                            <td>
                                                <div class="badge badge-<?php echo (Tratamento::getStatusEstoque($atv->status)['classe']) ?? 'danger'; ?>">
                                                    <i class="mdi mdi-archive-check ml-2"></i> <?php echo (Tratamento::getStatusEstoque($atv->status)['titulo']) ?? 'Desconhecido'; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

</div>

                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>

@endsection
