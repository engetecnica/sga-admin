<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Ativo</th>
            <th>Patrimônio</th>
            <th>Situação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detalhes->itens as $item)
        <tr>
            <td>{{ $item->item_nome }}</td>
            <td><span class="badge badge-danger">{{ $item->item_codigo_patrimonio; }}</span></td>
            <td><span class="badge badge-{{ $item->status_classe }}">{{ $item->status_item }}</span></td>
        </tr>
        @endforeach
    </tbody>
</table>