<form id="file-form" action="{{ route('ativo.interno.store.file') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modal-file" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="form-control" name="tipo" required>
                            <option value="">Tipo de anexo</option>
                            <option value="Recibo de Compra">Recibo de Compra</option>
                            <option value="Recibo de Manutenção">Recibo de Manutenção</option>
                            <option value="Declaração de Descarte">Declaração de Descarte</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Título do anexo</label>
                        <input class="form-control" name="titulo" type="text" placeholder="Título do anexo" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" name="descricao" type="text" placeholder="Descrição do anexo" required></textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input class="custom-file-input" name="file" type="file" required>
                                <label class="custom-file-label" for="file">Escolha o arquivo</label>
                            </div>
                        </div>
                        <span class="text-muted"> Formatos válidos: *.PDF, *.XLS, *.XLSx, *.JPG, *.PNG, *.JPEG, *.GIF Tamanho Máximo: 64M</span>
                    </div>
                    <input name="id_ativo_interno" type="hidden" value="{{ $ativo->id }}">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Inserir</button>
                </div>

            </div>
        </div>
    </div>
</form>
