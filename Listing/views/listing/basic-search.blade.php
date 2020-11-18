<form onsubmit="search()">
    <div class="form-group">
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg"
                       name="q"
                       id="listing_search"
                       value="{{ request()->get('q') }}"
                       placeholder="Buscar"
                       aria-label="Buscar">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <button
                        class="input-group-append btn btn-default p-0 border d-flex align-items-center"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        <span class="input-group-text bg-transparent border-0" id="basic-addon2">
                            <i class="fas fa-search"></i>
                        </span>
                    </button>
                    @if(!empty($listing['searchable']) || !empty($listing['filters']))
                        <div class="btn-group" role="group">
                            <button id="buscaAvancadaBtn"
                                    type="button"
                                    class="btn btn-lg btn-default dropdown-toggle border"
                                    data-toggle="modal"
                                    data-target="#modalBuscaAvancada">
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
