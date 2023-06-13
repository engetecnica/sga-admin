@extends('dashboard')
@section('title', 'Ativos Externos')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Veículos & Máquinas
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
            @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                <a class="btn btn-sm btn-danger" href="{{ route('ativo.veiculo.adicionar') }}">
                    Adicionar
                </a>
            @endif
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <table class="table-hover table-striped table" id="lista-simples">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>Obra</th>
                                <th>Tipo</th>
                                <th>Placa/ID Interna</th>
                                <th>Veículo</th>
                                <th>KM atual</th>
                                <th>HR Atual</th>
                                @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                                    <th width="10%">Ações</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                                @foreach ($veiculos->groupBy('id') as $veiculoId => $veiculosGrupo)
                                    @foreach ($veiculosGrupo as $veiculo)
                                        <tr>
                                            <td><span class="badge badge-dark">{{ $veiculo->id }}</span></td>
                                            <td><span class="badge badge-secondary">{{ $veiculo->obra->razao_social }}</span></td>
                                            @php
                                                $tiposVeiculos = [
                                                    'motos' => 'Moto',
                                                    'caminhoes' => 'Caminhão',
                                                    'carros' => 'Carro',
                                                    'maquinas' => 'Máquina',
                                                ];
                                            @endphp
                                            <td>
                                                @if ($veiculo->tipo == 'motos')
                                                    <span class="badge badge-primary">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @elseif ($veiculo->tipo == 'caminhoes')
                                                    <span class="badge badge-danger">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @elseif ($veiculo->tipo == 'carros')
                                                    <span class="badge badge-success">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @elseif ($veiculo->tipo == 'maquinas')
                                                    <span class="badge badge-warning">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($veiculo->tipo == 'maquinas')
                                                    <span class="badge badge-secondary">{{ $veiculo->codigo_da_maquina }}</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $veiculo->placa }}</span>
                                                @endif
                                            </td>
                                            <td class="text-uppercase">
                                                {{-- {{ $veiculo->marca }} | {{ $veiculo->modelo }} |  --}}
                                                {{ $veiculo->veiculo }}

                                            </td>
                                            <td>
                                                @if ($veiculo->tipo != 'maquinas')
                                                    @php
                                                        $ultimaQuilometragem = $veiculo->quilometragens->last();
                                                    @endphp
                                                    @if ($ultimaQuilometragem)
                                                        {{ $ultimaQuilometragem->quilometragem_nova }} KM
                                                    @else
                                                        {{ $veiculo->quilometragem_inicial }} KM
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($veiculo->tipo == 'maquinas')
                                                    @php
                                                        $ultimaQuilometragem = $veiculo->quilometragens->last();
                                                    @endphp
                                                    @if ($ultimaQuilometragem)
                                                        {{ $ultimaQuilometragem->quilometragem_nova }} HR
                                                    @else
                                                        {{ $veiculo->horimetro_inicial }} HR
                                                    @endif
                                                @endif
                                            </td>
                                            @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                                                <td class="d-flex gap-2">
                                                    <div class="dropdown">
                                                        <button class="badge badge-info" id="dropdownMenuButton1" data-bs-toggle="dropdown" type="button" aria-expanded="false">
                                                            <i class="mdi mdi-pencil"></i> Gerenciar
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.editar', $veiculo->id) }}">Editar</a></li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('ativo.veiculo.quilometragem.index', $veiculo->id) }}">
                                                                    @if ($veiculo->tipo == 'maquinas')
                                                                        Horímetro
                                                                    @else
                                                                        Quilometragem
                                                                    @endif
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.abastecimento.index', $veiculo->id) }}">Abastecimento</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.manutencao.index', $veiculo->id) }}">Manutenção</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.ipva.index', $veiculo->id) }}">IPVA</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.seguro.index', $veiculo->id) }}">Seguro</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.depreciacao.index', $veiculo->id) }}">Depreciação</a></li>
                                                        </ul>
                                                    </div>

                                                    <form action="{{ route('ativo.veiculo.delete', $veiculo->id) }}" method="POST">
                                                        @csrf
                                                        <a class="excluir-padrao" data-id="{{ $veiculo->id }}" data-table="empresas" data-module="cadastro/empresa">
                                                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja exluir o veículo?')"><i class="mdi mdi-delete"></i>
                                                                Excluir</button>
                                                        </a>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                @foreach ($veiculos->where('obra_id', session()->get('obra')->id)->groupBy('id') as $veiculoId => $veiculosGrupo)
                                    @foreach ($veiculosGrupo as $veiculo)
                                        <tr>
                                            <td><span class="badge badge-dark">{{ $veiculo->id }}</span></td>
                                            <td><span class="badge badge-secondary">{{ $veiculo->obra->razao_social }}</span></td>
                                            @php
                                                $tiposVeiculos = [
                                                    'motos' => 'Moto',
                                                    'caminhoes' => 'Caminhão',
                                                    'carros' => 'Carro',
                                                    'maquinas' => 'Máquina',
                                                ];
                                            @endphp
                                            <td>
                                                @if ($veiculo->tipo == 'motos')
                                                    <span class="badge badge-primary">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @elseif ($veiculo->tipo == 'caminhoes')
                                                    <span class="badge badge-danger">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @elseif ($veiculo->tipo == 'carros')
                                                    <span class="badge badge-success">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @elseif ($veiculo->tipo == 'maquinas')
                                                    <span class="badge badge-warning">{{ $tiposVeiculos[$veiculo->tipo] }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($veiculo->tipo == 'maquinas')
                                                    <span class="badge badge-secondary">{{ $veiculo->codigo_da_maquina }}</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $veiculo->placa }}</span>
                                                @endif
                                            </td>
                                            <td class="text-uppercase">
                                                {{-- {{ $veiculo->marca }} | {{ $veiculo->modelo }} |  --}}
                                                {{ $veiculo->veiculo }}

                                            </td>
                                            <td>
                                                @if ($veiculo->tipo != 'maquinas')
                                                    @php
                                                        $ultimaQuilometragem = $veiculo->quilometragens->last();
                                                    @endphp
                                                    @if ($ultimaQuilometragem)
                                                        {{ $ultimaQuilometragem->quilometragem_nova }} KM
                                                    @else
                                                        {{ $veiculo->quilometragem_inicial }} KM
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($veiculo->tipo == 'maquinas')
                                                    @php
                                                        $ultimaQuilometragem = $veiculo->quilometragens->last();
                                                    @endphp
                                                    @if ($ultimaQuilometragem)
                                                        {{ $ultimaQuilometragem->quilometragem_nova }} HR
                                                    @else
                                                        {{ $veiculo->horimetro_inicial }} HR
                                                    @endif
                                                @endif
                                            </td>
                                            @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                                                <td class="d-flex gap-2">
                                                    <div class="dropdown">
                                                        <button class="badge badge-info" id="dropdownMenuButton1" data-bs-toggle="dropdown" type="button" aria-expanded="false">
                                                            <i class="mdi mdi-pencil"></i> Gerenciar
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.editar', $veiculo->id) }}">Editar</a></li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('ativo.veiculo.quilometragem.index', $veiculo->id) }}">
                                                                    @if ($veiculo->tipo == 'maquinas')
                                                                        Horímetro
                                                                    @else
                                                                        Quilometragem
                                                                    @endif
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.abastecimento.index', $veiculo->id) }}">Abastecimento</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.manutencao.index', $veiculo->id) }}">Manutenção</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.ipva.index', $veiculo->id) }}">IPVA</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.seguro.index', $veiculo->id) }}">Seguro</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('ativo.veiculo.depreciacao.index', $veiculo->id) }}">Depreciação</a></li>
                                                        </ul>
                                                    </div>

                                                    <form action="{{ route('ativo.veiculo.delete', $veiculo->id) }}" method="POST">
                                                        @csrf
                                                        <a class="excluir-padrao" data-id="{{ $veiculo->id }}" data-table="empresas" data-module="cadastro/empresa">
                                                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja exluir o veículo?')"><i class="mdi mdi-delete"></i>
                                                                Excluir</button>
                                                        </a>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
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
