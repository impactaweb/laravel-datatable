<div class="modal fade show" id="modalBuscaAvancada" tabindex="-1" role="dialog"
     aria-labelledby="modalBuscaAvancadaLabel" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="get" class="frmBuscaAvancada" id="formBuscaAvacada">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalBuscaAvancadaLabel">Busca avancada</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: scroll;">
                    @include('datatable::search.filters', ['data' => $data])
                </div>
                <div class="modal-footer">
                    <a href="{{ request()->url() }}"
                       title="limpar busca"
                       class="btn btn-default">
                        Limpar
                    </a>
                    <button type="submit" class="btn btn-primary" data-avancada="buscar">
                        Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
