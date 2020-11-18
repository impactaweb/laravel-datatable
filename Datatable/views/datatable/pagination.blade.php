@if(!empty($data["data"]))
    <div class="form-row float-md-left align-items-center">
        <label class="col-md-auto col-form-label">Por página:</label>
        <div class="col-auto pl-0">
            <input
                type="number"
                value="{{ $data["pagination"]['per_page'] }}"
                class="form-control"
                name="per_page"
                onchange="setQs('per_page', event.target.value)"
                min="1"
                max="{{ $data['pagination']['total'] }}"
            >
        </div>

        <div class="col-auto data-listagem">
            <strong>
                {{ $data['pagination']['from'] . ' - ' . $data['pagination']['to'] }}
            </strong> de <strong>
                {{ $data['pagination']['total'] }}
            </strong>
            (<strong>
                {{ $data['pagination']['total_pages'] }}
            </strong> página{{ $data['pagination']['total_pages'] > 1 ? 's' : '' }})
        </div>
    </div>

    <div class="form-row float-md-right align-items-center">
        <label class="col-md-auto col-form-label">Ir para página:</label>
        <div class="col-auto pl-0">
            <input
                id="paginationPageNumber"
                type="number"
                class="form-control"
                name="page"
                onchange="setQs('page', event.target.value)"
                value="{{ $data['pagination']['current_page'] }}"
                min="1"
                max="{{ $data['pagination']['last_page'] }}"
            />
        </div>
        <div class="col-auto">
            @if($data['pagination']['current_page'] != 1)
                <a href="javascript:;" class="btn btn-default"
                   onclick="previousPage({{$data['pagination']['current_page']}})">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @else
                <a href="javascript:;" class="btn btn-default disabled">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            @if($data['pagination']['current_page'] != $data['pagination']['last_page'])
                <a href="javascript:;" class="btn btn-default"
                   onclick="nextPage({{$data['pagination']['current_page']}})">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <a href="javascript:;" class="btn btn-default disabled">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @endif

        </div>
        <div>
@endif
