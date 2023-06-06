@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span>
            @if ($veiculo->tipo == 'maquinas')
                Holímetro da máquina
            @else
                Quilometragem do veículo
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

                    {{-- @dd($store) --}}

                    <form method="post" action="{{ route('ativo.veiculo.quilometragem.store', $veiculo->id) }}">
                        @csrf
                        <div class="jumbotron p-3">
                            <span class="font-weight-bold">{{ $veiculo->marca }} | {{ $veiculo->modelo }} | {{ $veiculo->veiculo }}</span>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem_atual">
                                    @if ($veiculo->tipo == 'maquinas')
                                        Holímetro atual
                                    @else
                                        Quilometragem Atual
                                    @endif
                                </label>
                                @php
                                    $ultimaQuilometragem = $veiculo->quilometragens->last();
                                @endphp
                                <input class="form-control" id="quilometragem_atual" name="quilometragem_atual" type="number" value="{{ $ultimaQuilometragem->quilometragem_nova ?? old('quilometragem_atual') }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem_nova">
                                    @if ($veiculo->tipo == 'maquinas')
                                        Holímetro novo
                                    @else
                                        Quilometragem Nova
                                    @endif
                                </label>
                                <input class="form-control" id="quilometragem_nova" name="quilometragem_nova" type="number" value="{{ $veiculo->quilometragem_nova }}" min="{{ $ultimaQuilometragem->quilometragem_nova }}">
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <input name="veiculo_id" type="hidden" value="{{ $veiculo->id }}">
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
@endsection
