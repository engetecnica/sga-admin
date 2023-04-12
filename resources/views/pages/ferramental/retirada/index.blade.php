@extends('dashboard')
@section('title', 'Retirada de Ferramentas')
@section('content')


    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
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

                    <table class="table table-hover table-striped yajra-datatable">
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
                        

                        </tbody>
                    </table>
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

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: BASE_URL + "/ferramental/retirada/lista",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'codigo_obra',
                    name: 'obra'
                },
                {
                    data: 'solicitante',
                    name: 'solicitante'
                },
                {
                    data: 'funcionario',
                    name: 'funcionario'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'devolucao',
                    name: 'devolucao'
                },
                {
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
            order: [[2, 'asc']],
            language: {
                search: 'Buscar informação da Lista',
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
            },
        });

    });
</script>
