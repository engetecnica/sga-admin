<label class="form-label" for="{{ $field ?? 'id_obra' }}">{{ $title ?? 'Obra' }}</label>
<select class="form-select select2" id="{{ $field ?? 'id_obra' }}" name="{{ $field ?? 'id_obra' }}">
    <option value="">Selecione uma Obra</option>
    @foreach ($obras as $obra)
        <option value="{{ $obra->id }}" @php if(old($field ?? 'id_obra' , @$store->$field ?? 'id_obra') == $obra->id) echo "selected"; @endphp>
            {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
        </option>
    @endforeach
</select>
