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
                <table class="table-hover table-striped table pt-4">

                </table>

                <table class="table table-hover table-striped yajra-datatable pt-4 ">
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script lang="javascript">
    $(function() {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: BASE_URL + "/ativo/externo/lista",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'obra',
                    name: 'obra'
                },
                {
                    data: 'patrimonio',
                    name: 'patrimonio'
                },
                {
                    data: 'titulo',
                    name: 'titulo'
                },
                {
                    data: 'valor',
                    name: 'valor'
                },
                {
                    data: 'calibracao',
                    name: 'calibracao'
                }, {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'acoes',
                    name: 'acoes',
                    orderable: true,
                    searchable: true
                },
            ],
            pageLength: 50,
            order: [
                [0, 'desc']
            ],
            language: {
                search: 'Buscar informação da Lista',
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
            },
        });

    });
</script>
@endsection