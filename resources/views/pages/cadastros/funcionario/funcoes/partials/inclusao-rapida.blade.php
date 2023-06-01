<div class="modal fade" id="modal-funcao" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('cadastro.funcoes.fast.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <h5 class="mb-5">
                        Inclusão Rápida
                    </h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="funcao">Função</label>
                            <input class="form-control @error('funcao') is-invalid @enderror" id="funcao" name="funcao" type="text" value="{{ $funcao->funcao ?? old('funcao') }}" placeholder="Nome da função" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="codigo">Código CBO</label>
                            <input class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" type="text" value="{{ $funcao->codigo ?? old('codigo') }}" placeholder="Código CBO" required>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Adicionar</button>
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">Fechar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
