<div class="row mt-3">
    <div class="col-md-4">
        <label class="form-label" for="obra_id">Obra</label>
        <select class="form-select select2 @error('obra_id') is-invalid @enderror" id="obra_id" name="obra_id">
            <option value="">Selecione uma obra</option>

            @if (url()->current() == route('ativo.interno.create'))
                @foreach ($obras as $obra)
                    <option value="{{ $obra->id }}">{{ $obra->razao_social }}</option>
                @endforeach
            @else
                @foreach ($obras as $obra)
                    <option value="{{ $obra->id }}" {{ $ativo->obra_id == $obra->id ? 'selected=selected' : '' }}>{{ $obra->razao_social }}</option>
                @endforeach
            @endif

        </select>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-4">
        <label class="form-label" for="titulo">Título</label>
        <input class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" type="text" value="{{ $ativo->titulo ?? old('titulo') }}" placeholder="Título">
    </div>

    <div class="col-md-4">
        <label class="form-label" for="numero_serie">Nº de série</label>
        <input class="form-control @error('numero_serie') is-invalid @enderror" id="numero_serie" name="numero_serie" type="text" value="{{ $ativo->numero_serie ?? old('numero_serie') }}" placeholder="Nº de série">
    </div>

    <div class="col-md-4">
        <label class="form-label" for="patrimonio">Patrimônio</label>
        <input class="form-control @error('patrimonio') is-invalid @enderror" id="patrimonio" name="patrimonio" type="text" value="{{ $ativo->patrimonio ?? old('patrimonio') }}" placeholder="Patrimônio">
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-4">
        <label class="form-label" for="valor_atribuido">Valor</label>
        <input class="form-control money @error('valor_atribuido') is-invalid @enderror" id="valor_atribuido" name="valor_atribuido" type="text" value="{{ $ativo->valor_atribuido ?? old('valor_atribuido') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label" for="marca">Marca </label> <button class="badge badge-primary" data-toggle="modal" data-target="#modal-marcas" type="button"><i class="mdi mdi-plus"></i></button>
        <select class="form-select select2 @error('marca') is-invalid @enderror" id="marca" name="marca">
            <option value="">Selecione uma marca</option>

            @if (url()->current() == route('ativo.interno.create'))
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->marca }}">{{ $marca->marca }}</option>
                @endforeach
            @else
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->marca }}" {{ $ativo->marca == $marca->marca ? 'selected=selected' : '' }}>{{ $marca->marca }}</option>
                @endforeach
            @endif

        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label" for="status">Ativo? </label>
        <select class="form-control form-select @error('status') is-invalid @enderror" id="status" name="status">
            @if (url()->current() == route('ativo.interno.create'))
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            @else
                <option value="1">Ativo</option>
                <option value="0" {{ @$ativo->status == 0 ? 'selected=selected' : '' }}>Inativo</option>
            @endif

        </select>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label" for="descricao">Descrição</label>
            <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" cols="30" rows="10">{{ $ativo->descricao ?? old('descricao') }}</textarea>
        </div>
    </div>
</div>
