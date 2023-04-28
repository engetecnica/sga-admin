@extends('dashboard')
@section('title', 'Ativos Externos')
@section('content')


    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Veículos
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Veículos <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            <a href="{{ route('ativo.veiculo.adicionar') }}">
                <button class="btn btn-sm btn-danger">Inclusão de Novos Veículos</button>
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
                                <th>TIPO</th>
                                <th>Combustível</th>
                                <th>KM atual</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($veiculos as $veiculo)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $veiculo->id }}</span></td>

                                    <td>{{ $veiculo->tipo }}</td>
                                    <td>{{ $veiculo->abastecimento->combustivel }}</td>
                                    <td>{{ $veiculo->quilometragem->quilometragem_atual }}</td>
                                    <td>

                                        <a href="{{ route('ativo.veiculo.editar', $veiculo->id) }}">
                                            <button class="badge badge-info" data-toggle="tooltip" data-placement="top"
                                                title="Editar"><i class="mdi mdi-pencil"></i> Editar</button>
                                        </a>

                                        <a href="javascript:void(0)" class="excluir-padrao" data-id="{{ $veiculo->id }}"
                                            data-table="empresas" data-module="cadastro/empresa"
                                            data-redirect="{{ route('empresa') }}">
                                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top"
                                                title="Excluir"><i class="mdi mdi-delete"></i> Excluir</button>
                                        </a>
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
                    data: 'id_ativo_configuracao',
                    name: 'categoria'
                },
                {
                    data: 'titulo',
                    name: 'titulo'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
            order: [
                [2, 'asc']
            ],
            language: {
                search: 'Buscar informação da Lista',
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
            },
        });

    });
</script>
