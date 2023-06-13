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
        <a href="{{ route('ativo.externo.inserir', $detalhes->id) }}">
            <button class="btn btn-sm btn-danger">Incluir Pertencentes</button>
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
                                        <td>{{ $detalhes->id }}</td>
                                        <td>{{ $detalhes->categoria->titulo }}</td>
                                        <td>{{ $detalhes->titulo }}</td>
                                        <td>{{ Tratamento::datetimeBr($detalhes->created_at) }} </td>
                                        <td>
                                            <div class="badge badge-warning">{{ $detalhes->status }}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="card-body">
                            <h4 class="card-title">Itens pertencentes ao Estoque</h4>
                            <hr>
                            <table class="table-hover table-striped yajra-datatable table pt-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Patrimônio</th>
                                        <th>Obra Atual</th>
                                        <th>Valor do Item</th>
                                        <th>Calibração?</th>
                                        <th>Data de Descarte</th>
                                        <th>Data de Inclusão</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itens as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td class="text-center"><span class="badge badge-primary">{{ $item->patrimonio }}</span></td>
                                        <td class="text-center"><span class="badge badge-danger">{{ $item->obra->codigo_obra }}</span></td>
                                        <td class="text-right">R$ {{ $item->valor }}</td>
                                        <td class="text-center">
                                            @if ($item->calibracao == 0)
                                            Não
                                            @elseif ($item->calibracao == 1)
                                            Sim
                                            @else
                                            NULO
                                            @endif
                                        </td>
                                        <td>{{ $item->data_descarte }}</td>
                                        <td>{{ Tratamento::datetimeBr($item->created_at) }}</td>
                                        <td class="text-center"><span class="badge badge-{{ $item->situacao->classe }}">{{ $item->situacao->titulo }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Patrimônio</th>
                                        <th>Obra Atual</th>
                                        <th>Valor do Item</th>
                                        <th>Calibração?</th>
                                        <th>Data de Descarte</th>
                                        <th>Data de Inclusão</th>
                                        <th>Situação</th>
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
{{--
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
</script> --}}