<form id="servicos-form">
    <div class="modal fade" id="modal-servicos" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label for="name">Serviço</label>
                        <input class="form-control" id="servicos_modal" name="name" type="text" placeholder="Serviço" required>
                    </div>
                    <input id="_token_modal" name="newToken" type="hidden" value="{{ csrf_token() }}">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</form>
