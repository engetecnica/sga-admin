@extends('dashboard')
@section('title', 'Veículo')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Depreciação do veículo
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
                        $action = isset($store) ? route('ativo.veiculo.depreciacao.update', $store->id) : route('ativo.veiculo.depreciacao.store', $store->id);
                    @endphp
                    <form method="post" enctype="multipart/form-data" action="{{ $action }}">
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="valor_atual" class="form-label">Valor Atual</label>
                                <input type="text" class="form-control" id="valor_atual"
                                    value="{{ old('valor_atual', @$store->valor_atual) }}" name="valor_atual"
                                    placeholder="R$ 0,00">

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="referencia_mes" class="form-label">Mês de referência</label>
                                <select name="referencia_mes" id="referencia_mes" class="form-select">
                                    <option value="" @if (!isset($store) || !$store->referencia_mes) selected @endif>Selecione
                                    </option>
                                    <option value="janeiro" @if (isset($store) && $store->referencia_mes == 'janeiro') selected @endif>Janeiro
                                    </option>
                                    <option value="fevereiro" @if (isset($store) && $store->referencia_mes == 'fevereiro') selected @endif>Fevereiro
                                    </option>
                                    <option value="marco" @if (isset($store) && $store->referencia_mes == 'marco') selected @endif>Março</option>
                                    <option value="abril" @if (isset($store) && $store->referencia_mes == 'abril') selected @endif>Abril</option>
                                    <option value="maio" @if (isset($store) && $store->referencia_mes == 'maio') selected @endif>Maio</option>
                                    <option value="junho" @if (isset($store) && $store->referencia_mes == 'junho') selected @endif>Junho</option>
                                    <option value="julho" @if (isset($store) && $store->referencia_mes == 'julho') selected @endif>Julho</option>
                                    <option value="agosto" @if (isset($store) && $store->referencia_mes == 'agosto') selected @endif>Agosto</option>
                                    <option value="setembro" @if (isset($store) && $store->referencia_mes == 'setembro') selected @endif>Setembro
                                    </option>
                                    <option value="outubro" @if (isset($store) && $store->referencia_mes == 'outubro') selected @endif>Outubro
                                    </option>
                                    <option value="novembro" @if (isset($store) && $store->referencia_mes == 'novembro') selected @endif>Novembro
                                    </option>
                                    <option value="dezembro" @if (isset($store) && $store->referencia_mes == 'dezembro') selected @endif>Dezembro
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="referencia_ano" class="form-label">Ano de referência</label>
                                <input type="number" class="form-control" id="referencia_ano"
                                    value="{{ old('referencia_ano', @$store->referencia_ano) }}"
                                    name="referencia_ano">
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
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#valor_atual').mask('000.000.000.000.000,00', {
            reverse: true
        });
    });
</script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function($) {
        $('#valor_atual').mask('000.000.000.000.000,00', {
            reverse: true
        });
    });
</script> --}}
