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
                <!-- <form action="{{ route('ativo.externo.search') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">

                        <style>
                            .select-default-search {
                                width: 100%;
                                border: solid 1px !important;
                                border-color: #EDEDED !important;
                            }

                            .select-default-search option {
                                background-color: #FFF;
                            }

                            .span-default-search {
                                display: flex
                            }

                            .span-default-search i {
                                margin-right: 10px;
                                color: #C02028;
                                font-size: 26px;
                            }

                            .span-default-search h6 {
                                margin-top: 10px;
                            }

                            label {
                                font-size: 14px
                            }
                        </style>



                        <div class="row">
                            <span class="span-default-search">
                                <i class="mdi mdi-account-search"></i>
                                <h6>PESQUISAR ATIVO</h6>
                            </span>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label" for="status">Filtrar por Obra</label>
                                <select class="form-select-sm select-default-search select2" id="id_obra" name="id_obra">
                                    <option value="">Todas as obras</option>
                                    <option>obra 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label" for="status">Filtrar por Categoria</label>
                                <select class="form-select-sm select-default-search select2" id="id_ativo_configuracao" name="id_ativo_configuracao">
                                    <option value="">Todas as categorias</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label class="form-label" for="codigo_patrimonio">Código do Patrimônio</label>
                                <input class="form-control select-default-search" id="codigo_patrimonio" name="codigo_patrimonio" type="text">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" for="status">Situação do Estoque</label>
                                <select class="form-select-sm select-default-search select2" id="status" name="status">
                                    <option value="">Todas</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-gradient-dark btn-sm font-weight-medium" type="submit">Pesquisar</button>
                            </div>
                        </div>
                    </div>
                </form> -->

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

<!-- Modal
<div class="modal fade" id="calibrarItem" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="calibrarItem" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calibrarItem">Calibrar Item</h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancelar</button>
                <button class="btn btn-warning retirada-assinar-termo" data-tipo="manual" type="button">Enviar Calibração</button>
            </div>
        </div>
    </div>
</div> -->

@include('components.anexo.form', [
'path' => 'itenscalibrados',
'id_item' => 1,
'id_modulo' => 18,
])


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