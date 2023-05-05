@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Quilometragem do veículo
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Cadastros <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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

                    @php
                        $action = isset($store) ? route('ativo.veiculo.quilometragem.update', $store->id) : route('ativo.veiculo.quilometragem.store', $store->id);
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf
                        {{ $store->quilometragens }}
                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="quilometragem_atual" class="form-label">Quilometragem Atual</label>
                                <input type="number" class="form-control" id="quilometragem_atual"
                                    value="{{ old('quilometragem_atual', @$store->quilometragem_atual) }}"
                                    name="quilometragem_atual">
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-md-4">
                                <label for="quilometragem_nova" class="form-label">Quilometragem Nova</label>
                                <input type="number" class="form-control" id="quilometragem_nova"
                                    value="{{ old('quilometragem_nova', @$store->quilometragem_nova) }}"
                                    name="quilometragem_nova">
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit"
                                class="btn btn-gradient-primary btn-lg font-weight-medium">Salvar</button>

                            <a href="{{ route('ativo.veiculo') }}">
                                <button type="button"
                                    class="btn btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
