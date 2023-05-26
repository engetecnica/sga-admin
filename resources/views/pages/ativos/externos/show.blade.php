@extends('dashboard')
@section('title', 'Ativos Externos - Detalhes')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
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
                                <h4 class="card-title">Item</h4>
                                <hr>
                                <table class="table-bordered table-striped table-houver table">
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
                                            <td><?php echo $detalhes['categoria']; ?></td>
                                            <td><?php echo $detalhes['titulo']; ?></td>
                                            <td><?php echo date('d/m/Y H:i:s', strtotime($detalhes['created_at'])); ?> </td>
                                            <td>
                                                <div class="badge badge-warning"><?php echo $detalhes['status']; ?></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Estatísticas
                                        <div class="col-12 grid-margin">
                                            <div class="card card-statistics">
                                                <div class="row">
                                                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                                                        <div class="card-body">
                                                            <div
    class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                                                <i
    class="mdi mdi-account-multiple-outline text-primary mr-sm-4 icon-lg mr-0"></i>
                                                                <div class="wrapper text-sm-left">
                                                                    <p class="card-text mb-0">Pendentes</p>
                                                                    <div class="fluid-container">
                                                                        <h3 class="font-weight-medium mb-0">150</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                                                        <div class="card-body">
                                                            <div
    class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                                                <i
    class="mdi mdi-checkbox-marked-circle-outline text-primary mr-sm-4 icon-lg mr-0"></i>
                                                                <div class="wrapper text-sm-left">
                                                                    <p class="card-text mb-0 ml-3">Em Estoque</p>
                                                                    <div class="fluid-container">
                                                                        <h3 class="font-weight-medium mb-0">0</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                                                        <div class="card-body">
                                                            <div
    class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                                                <i class="mdi mdi-trophy-outline text-primary mr-sm-4 icon-lg mr-0"></i>
                                                                <div class="wrapper text-sm-left">
                                                                    <p class="card-text mb-0">Em Operação</p>
                                                                    <div class="fluid-container">
                                                                        <h3 class="font-weight-medium mb-0">0</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
                                                        <div class="card-body">
                                                            <div
    class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                                                <i class="mdi mdi-target text-primary mr-sm-4 icon-lg mr-0"></i>
                                                                <div class="wrapper text-sm-left">
                                                                    <p class="card-text mb-0">Em Manutenção</p>
                                                                    <div class="fluid-container">
                                                                        <h3 class="font-weight-medium mb-0">0</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        End Estatísticas -->

                            <div class="card-body">
                                <h4 class="card-title">Itens pertencentes ao Estoque</h4>
                                <hr>
                                <table class="table-hover table-striped yajra-datatable table pt-4">
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

                                    </tbody>
                                    <tfoot>
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
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script lang="javascript">
    $(function() {

        var id = "{{ $detalhes['id'] }}"

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: BASE_URL + "/ativo/externo/search/" + id,
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'patrimonio',
                    name: 'patrimonio'
                },
                {
                    data: 'id_obra',
                    name: 'obra_atual'
                },
                {
                    data: 'valor',
                    name: 'valor'
                },
                {
                    data: 'calibracao',
                    name: 'calibracao'
                },
                {
                    data: 'data_descarte',
                    name: 'data_descarte'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    searchable: true
                },
            ],
            language: {
                search: 'Buscar informação da Lista',
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
            },
            pageLength: 50
        });

    });
</script>
