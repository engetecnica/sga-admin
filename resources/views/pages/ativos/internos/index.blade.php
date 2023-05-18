@extends('dashboard')
@section('title', 'Ativos Externos')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Ativos Internos
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
            <a href="{{ route('ativo.interno.create') }}">
                <button class="btn btn-sm btn-danger">Cadastrar novo patrimônio</button>
            </a>
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <table class="table-responsive table-hover table-striped table" id="lista-simples">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>Obra</th>
                                <th>Patrimônio</th>
                                <th>Nº de série</th>
                                <th>Título</th>
                                <th>Marca</th>
                                <th>Valor</th>
                                <th>Inclusão</th>
                                <th>Situação</th>

                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ativos as $ativo)
                                <tr>
                                    <td class="text-center align-middle"><span class="badge badge-dark">{{ $ativo->id }}</span></td>
                                    <td class="align-middle">{{ $ativo->obra->razao_social }}</td>
                                    <td class="align-middle">{{ $ativo->patrimonio }}</td>
                                    <td class="align-middle">{{ $ativo->numero_serie }}</td>
                                    <td class="align-middle">{{ $ativo->titulo }}</td>
                                    <td class="align-middle">{{ $ativo->marca }}</td>
                                    <td class="align-middle">R$ {{ Tratamento::currencyFormatBr($ativo->valor_atribuido) }}</td>
                                    <td class="align-middle">{{ Tratamento::datetimeBr($ativo->created_at) }}</td>
                                    <td class="text-center align-middle">
                                        @if ($ativo->status == 1)
                                            <span class="badge badge-success">Ativo</span>
                                        @elseif ($ativo->status == 0)
                                            <span class="badge badge-danger">Inativo</span>
                                        @else
                                            <span class="badge badge-danger">Inativo</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-2 align-middle">
                                        <div class="dropdown">
                                            <button class="badge badge-info" id="dropdownMenuButton1" data-bs-toggle="dropdown" type="button" aria-expanded="false">
                                                <i class="mdi mdi-pencil"></i> Gerenciar
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="{{ route('ativo.interno.edit', $ativo->id) }}">Editar</a></li>
                                                <li><a class="dropdown-item" href="{{ route('ativo.interno.show', $ativo->id) }}" target="_blank">Gerar etiqueta</a></li>
                                            </ul>
                                        </div>

                                        <form action="{{ route('ativo.interno.destroy', $ativo->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir">
                                                <i class="mdi mdi-delete"></i> Excluir
                                            </button>
                                        </form>
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
            ajax: BASE_URL + "/ativo/interno/lista",
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
