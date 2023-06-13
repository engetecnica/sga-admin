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
                    Ativos
                </li>
            </ul>
        </nav>
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

                    <form method="post" action="{{ route('ativo.veiculo.manutencao.store') }}">
                        @csrf
                        <div class="jumbotron p-3">
                            <span class="font-weight-bold">{{ $veiculo->marca }} | {{ $veiculo->modelo }} | {{ $veiculo->veiculo }}</span>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="fornecedor_id">Fornecedor</label>
                                <select class="form-select select2" id="fornecedor_id" name="fornecedor_id" required>
                                    <option value="">Selecione</option>
                                    @foreach ($fornecedores as $fornecedor)
                                        <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>
                                            {{ $fornecedor->razao_social }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="servico_id">Serviço</label> <button class="badge badge-primary" data-toggle="modal" data-target="#modal-servicos" type="button"><i class="mdi mdi-plus"></i></button>
                                <select class="form-control select2" id="servico_id" name="servico_id" required>
                                    <option value="">Selecione</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}" {{ old('servico_id') == $servico->id ? 'selected' : '' }}>
                                            {{ $servico->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="tipo">Método da Preventiva</label>
                                <select class="form-select select2" id="tipo" name="tipo" required>
                                    @if ($veiculo->tipo == 'maquinas')
                                        <option value="horas" {{ old('tipo') == 'horas' ? 'selected' : '' }}>Horas</option>
                                    @else
                                        <option value="">Selecione</option>
                                        <option value="quilometragem" {{ old('tipo') == 'quilometragem' ? 'selected' : '' }}>Quilometragem</option>
                                        <option value="tempo" {{ old('tipo') == 'tempo' ? 'selected' : '' }}>Tempo</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        @if ($veiculo->tipo == 'maquinas')
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="horimetro_atual">Horímetro atual da máquina</label>
                                    @php
                                        $ultima_quilometragem = $veiculo->quilometragens->last();
                                    @endphp
                                    <input class="form-control" id="horimetro_atual" name="horimetro_atual" type="number" value="{{ $ultima_quilometragem->quilometragem_nova ?? old('horimetro_atual') }}" min="{{ $ultima_quilometragem->quilometragem_nova }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="horimetro_proximo">Próximo Horímetro (Preventiva)</label>
                                    <input class="form-control" id="horimetro_proximo" name="horimetro_proximo" type="number" value="{{ old('horimetro_proximo') }}" min="{{ $ultima_quilometragem->quilometragem_nova }}">
                                </div>
                            </div>
                        @else
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="quilometragem_atual">Quilometragem atual do veículo</label>
                                    @php
                                        $ultima_quilometragem = $veiculo->quilometragens->last();
                                    @endphp
                                    <input class="form-control" id="quilometragem_atual" name="quilometragem_atual" type="number" value="{{ $ultima_quilometragem->quilometragem_nova ?? old('quilometragem_atual') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="quilometragem_proxima">Próxima Quilometragem (Preventiva)</label>
                                    <input class="form-control" id="quilometragem_proxima" name="quilometragem_proxima" type="number" value="{{ old('quilometragem_proxima') }}">
                                </div>
                            </div>
                        @endif

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="data_de_execucao">Data de Execução</label>
                                <input class="form-control" id="data_de_execucao" name="data_de_execucao" type="date" value="{{ old('data_de_execucao') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="data_de_vencimento">Data de Vencimento</label>
                                <input class="form-control" id="data_de_vencimento" name="data_de_vencimento" type="date" value="{{ old('data_de_vencimento') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="situacao">Situação</label>
                                <select class="form-select select2" id="situacao" name="situacao">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ old('situacao') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="2" {{ old('situacao') == 'Em Execução' ? 'selected' : '' }}>Em Execução</option>
                                    <option value="3" {{ old('situacao') == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                                    <option value="4" {{ old('situacao') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="valor_do_servico">Valor do Serviço</label>
                                <input class="form-control" id="valor_do_servico" name="valor_do_servico" type="text" value="{{ old('valor_do_servico') }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8">
                                <label class="form-label" for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" cols="30" rows="6">{{ old('descricao') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <input name="veiculo_id" type="hidden" value="{{ $veiculo->id }}">
                            <input name="veiculo_tipo" type="hidden" value="{{ $veiculo->tipo }}">
                            <button class="btn btn-gradient-primary btn-lg font-weight-medium" type="submit">Salvar</button>

                            <a href="{{ route('ativo.veiculo') }}">
                                <button class="btn btn-gradient-danger btn-lg font-weight-medium" type="button">Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('pages.ativos.veiculos.manutencao.servicos-inclusao-rapida')
@endsection
