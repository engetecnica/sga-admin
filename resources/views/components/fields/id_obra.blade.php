<label for="id_obra" class="form-label">Obra</label>
<select name="id_obra" id="id_obra" class="form-select select2">
    <option value="">Selecione uma Obra</option>
    @foreach ($obras as $obra)
        <option value="{{ $obra->id }}" 
            @php if(old('id_obra', @$store->id_obra) == $obra->id) echo "selected"; @endphp>
            {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
        </option>
    @endforeach
</select>