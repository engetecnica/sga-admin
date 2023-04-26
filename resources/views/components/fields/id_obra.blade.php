<label for="{{ $field ?? 'id_obra' }}" class="form-label">{{ $title ?? 'Obra' }}</label>
<select name="{{ $field ?? 'id_obra' }}" id="{{ $field ?? 'id_obra' }}" class="form-select select2">
    <option value="">Selecione uma Obra</option>
    @foreach ($obras as $obra)
    <option value="{{ $obra->id }}" @php if(old($field ?? 'id_obra' , @$store->$field ?? 'id_obra') == $obra->id) echo "selected"; @endphp>
        {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
    </option>
    @endforeach
</select>