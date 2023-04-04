<label for="id_funcao" class="form-label">Função</label>
<select name="id_funcao" id="id_funcao" class="form-select select2">
    <option value="">Selecione uma Função</option>
    @foreach ($funcoes as $funcao)
        <option value="{{ $funcao->id }}" 
            @php if(old('id_funcao', @$store->id_funcao) == $funcao->id) echo "selected"; @endphp>
            {{ $funcao->codigo_cbo }} - {{ $funcao->titulo }}
        </option>
    @endforeach
</select>