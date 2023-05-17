@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Quilometragem do veículo
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <button class="btn btn-success">
                        <a class="text-white" href="{{ route('ativo.veiculo.quilometragem.index', $store->veiculo_id) }}">
                            <i class="mdi mdi-arrow-left icon-sm align-middle text-white"></i> Voltar
                        </a>
                    </button>
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

                    <form method="post" enctype="multipart/form-data" action="{{ $btn == 'add' ? route('ativo.veiculo.quilometragem.store', $store->veiculo_id) : route('ativo.veiculo.quilometragem.update', $store->id) }}">
                        @csrf
                        {{ $store->quilometragens }}
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem_atual">Quilometragem Atual</label>
                                <input class="form-control" id="quilometragem_atual" name="quilometragem_atual" type="number" value="{{ old('quilometragem_nova', @$store->quilometragem_nova) }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label" for="quilometragem_nova">Quilometragem Nova</label>
                                <input class="form-control" id="quilometragem_nova" name="quilometragem_nova" type="number" value="{{ old('quilometragem_nova', @$store->quilometragem_nova) }}">
                            </div>
                        </div>

                        <div class="col-12 mt-5">
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
