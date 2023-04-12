<!-- Modal -->
<div class="modal fade" id="anexarArquivo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="gerarTermoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gerarTermoLabel">Anexo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('anexo.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titulo" class="col-form-label">Titulo:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="arquivo" class="col-form-label">Arquivo:</label>
                        <input type="file" class="form-control" id="arquivo" name="arquivo" required>
                    </div>
                    <div class="mb-3">
                        <label for="detalhes" class="col-form-label">Detalhes:</label>
                        <textarea class="form-control" id="detalhes" name="detalhes"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning retirada-assinar-termo">Salvar Anexo</button>
                </div>
            </form>
        </div>
    </div>
</div>
