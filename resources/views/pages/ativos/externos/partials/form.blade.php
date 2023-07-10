<div class="row">
    <div class="col-md-12">
        {{-- @dd($ativo_configuracoes) --}}
        <label class="form-label" for="id_ativo_configuracao">Categoria</label>
        <select class="form-control select2" id="id_ativo_configuracao" name="id_ativo_configuracao">

            <option value="">Selecione uma Categoria</option>
            @if (url()->current() == route('ativo.externo.adicionar'))
            @foreach ($ativo_configuracoes as $configuracao)
            @if ($configuracao->id_relacionamento == 0)
            <optgroup label="{{ $configuracao->titulo }}" readonly>
                @else
                <option value="{{ $configuracao->id }}">{{ $configuracao->titulo }}</option>
                @endif
                @endforeach
                @else
                @foreach ($ativo_configuracoes as $configuracoes)
                <option value="{{ $configuracoes->id }}" {{ $ativo->ativo->id_ativo_configuracao == $configuracoes->id ? 'selected' : '' }}>{{ $configuracoes->titulo }}</option>
                @endforeach
                @endif
        </select>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <label class="form-label" for="id_obra">Obra</label> <button class="badge badge-primary" data-toggle="modal" data-target="#modal-add" type="button"><i class="mdi mdi-plus"></i></button>
        <select class="form-select select2" id="id_obra" name="id_obra">
            <option value="">Selecione uma Obra</option>
            @if (url()->current() == route('ativo.externo.adicionar'))
            @foreach ($obras as $obra)
            <option value="{{ $obra->id }}">
                {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
            </option>
            @endforeach
            @else
            @foreach ($obras as $obra)
            <option value="{{ $obra->id }}" {{ $ativo->id_obra == $obra->id ? 'selected' : '' }}>
                {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
            </option>
            @endforeach
            @endif

        </select>
    </div>
</div>


<div class="row mt-3">
    <div class="col-md-6">
        <label class="form-label" for="titulo">Título</label>
        <input class="form-control" id="titulo" name="titulo" type="text" value="{{ $ativo->ativo->titulo ?? old('titulo') }}">
    </div>

    <div class="col-md-2">
        <label class="form-label" for="status">Quantidade</label>
        <input class="form-control" id="quantidade" name="quantidade" type="number" value="{{ $item->quantidade_estoque ?? old('quantidade') }}">
    </div>

    <div class="col-md-2">
        <label class="form-label" for="status">Valor</label>
        <input class="form-control money" id="valor" name="valor" type="text" value="{{ $ativo->valor ?? old('valor') }}">
    </div>

    <div class="col-md-2">
        <label class="form-label" for="calibracao">Precisa Calibrar?</label>
        <select class="form-select select2" id="calibracao" name="calibracao">
            @if (url()->current() == route('ativo.externo.adicionar'))
            <option value="1">Sim</option>
            <option value="0">Não</option>
            @else
            <option value="1">Sim</option>
            <option value="0" {{ $ativo->calibracao == 0 ? 'selected' : '' }}>Não</option>
            @endif
        </select>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-3">
        <label class="form-label" for="status">Status</label>
        <select class="form-select select2" id="status" name="status">
            <option value="Ativo" selected>Em Estoque</option>
        </select>
    </div>
</div>