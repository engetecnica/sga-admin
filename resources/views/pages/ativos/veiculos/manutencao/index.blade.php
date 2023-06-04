@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span>
            @if ($veiculo->tipo == 'maquinas')
                Manutenção da Máquina
            @else
                Manutenção do Veículo
            @endif
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    Ativos <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            <a class="btn btn-sm btn-danger" href="{{ route('ativo.veiculo.manutencao.adicionar', $veiculo->id) }}">
                Adicionar
            </a>
        </h3>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Ops!</strong><br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- DADOS DO VEÍCULO/MÁQUINA --}}
                    @include('pages.ativos.veiculos.partials.header')

                    <table class="table-hover table-striped table">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>Fornecedor</th>
                                <th>Serviço</th>
                                <th>Custo</th>
                                @if ($veiculo->tipo == 'maquinas')
                                    <th>HR Atual</th>
                                    <th>HR Próxima Revisão</th>
                                @else
                                    <th>KM Atual</th>
                                    <th>KM Próxima Revisão</th>
                                @endif
                                <th>Data De Entrada</th>
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manutencoes as $manutencao)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $manutencao->id }}</span></td>
                                    <td>{{ $manutencao->fornecedor->razao_social }}</td>
                                    <td>{{ $manutencao->servico->name }}</td>
                                    <td>R$ {{ Tratamento::formatFloat($manutencao->valor_do_servico) }} </td>
                                    @if ($veiculo->tipo == 'maquinas')
                                        <td>{{ $manutencao->horimetro_atual }} HR</td>
                                        <td>{{ $manutencao->horimetro_proximo }} HR</td>
                                    @else
                                        <td>{{ $manutencao->quilometragem_atual }} KM</td>
                                        <td>{{ $manutencao->quilometragem_proxima }} KM</td>
                                    @endif
                                    <td>{{ Tratamento::datetimeBr($manutencao->created_at) }}</td>
                                    <td class="d-flex gap-2">

                                        <a href="{{ route('ativo.veiculo.manutencao.editar', [$manutencao->id, 'edit']) }}">
                                            <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar
                                            </button>
                                        </a>

                                        <form action="{{ route('ativo.veiculo.manutencao.delete', $manutencao->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a class="excluir-padrao" data-id="{{ $manutencao->id }}" data-table="empresas" data-module="cadastro/empresa">
                                                <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                                    <i class="mdi mdi-delete"></i> Excluir</button>
                                            </a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var valorDoLitroInput = document.getElementById('valor_do_litro');
        var quantidadeInput = document.getElementById('quantidade');
        var valorTotalInput = document.getElementById('valor_total');

        valorDoLitroInput.addEventListener('change', updateValorTotal);
        quantidadeInput.addEventListener('change', updateValorTotal);

        function updateValorTotal() {
            var valorDoLitro = parseFloat(valorDoLitroInput.value);
            var quantidade = parseFloat(quantidadeInput.value);

            var valorTotal = valorDoLitro * quantidade;

            valorTotalInput.value = valorTotal.toFixed(2);
        }
    });
</script>
