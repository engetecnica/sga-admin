@extends('dashboard')
@section('title', 'Mensagens')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Mensagens
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Envio de Mensagem <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
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

                @php $action = isset($store) ? route('ferramenta.mensagem.update', $store->id) : route('ferramenta.mensagem.store'); @endphp
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ $action }}">
                    @csrf

                    <div class="col-12">
                        <label for="id_cliente" class="form-label">Clientes</label>
                        <select name="id_cliente" id="id_cliente" class="form-control select2">
                            <option value="-1">Todos os clientes</option>
                            <?php foreach ($clientes as $cliente) { ?>
                                <option value="{{ $cliente->id }}">{{ $cliente->empresa . ' | '. $cliente->nome . ' - ' . $cliente->celular }}</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="id_cliente" class="form-label">Título da Mensagem</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="">
                    </div>

                    <div class="col-md-12">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea class="form-control" name="mensagem" id="mensagem" rows="5" onkeyup="limite_textarea(400, this.value, 'mensagem')"></textarea>
                        <p><span id="cont" class="text-warning">400</span> restantes</p>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium">Enviar</button>

                        <a href="{{ route('usuario') }}">
                            <button type="button" class="btn btn-block btn-gradient-danger btn-lg font-weight-medium">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection