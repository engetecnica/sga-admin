<div class="jumbotron p-3">
    <table class="table">
        <thead>
            <tr>
                @if ($veiculo->tipo == 'maquinas')
                    <th width="8%">ID Máquina</th>
                @else
                    <th>Placa</th>
                @endif
                <th>Descrição</th>
                @if ($veiculo->tipo == 'maquinas')
                    <th>Horímetro Atual</th>
                @else
                    <th>KM atual</th>
                @endif

                <th>Inclusão</th>
                <th width="10%">Ações</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                @if ($veiculo->tipo == 'maquinas')
                    <td><span class="badge badge-dark">{{ $veiculo->codigo_da_maquina }}</span></td>
                @else
                    <td><span class="badge badge-dark">{{ $veiculo->placa }}</span></td>
                @endif

                <td>{{ $veiculo->marca }} | {{ $veiculo->modelo }} | {{ $veiculo->veiculo }}</td>

                @php
                    $ultima_quilometragem = $veiculo->quilometragens->last();
                @endphp
                @if ($veiculo->tipo == 'maquinas')
                    <td>{{ $ultima_quilometragem->quilometragem_nova }} HR</td>
                @else
                    <td>{{ $ultima_quilometragem->quilometragem_nova }} km</td>
                @endif

                <td>{{ Tratamento::datetimeBr($veiculo->created_at) }}</td>

                <td class="d-flex">
                    <div class="dropdown mr-2">
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
                            <li><a class="dropdown-item" href="#">Anexos</a></li>
                        </ul>
                    </div>
                    <form action="{{ route('ativo.veiculo.delete', $veiculo->id) }}" method="POST">
                        @csrf
                        <a class="excluir-padrao" data-id="{{ $veiculo->id }}" data-table="empresas" data-module="cadastro/empresa">
                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o veículo?')">
                                <i class="mdi mdi-delete"></i> Excluir
                            </button>
                        </a>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
