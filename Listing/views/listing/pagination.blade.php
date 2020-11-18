@if(!empty($listing["data"]))
    <div class="form-row float-md-left align-items-center">
        <label class="col-md-auto col-form-label">Por página:</label>
        <div class="col-auto pl-0">
            <input
                type="number"
                value="{{ $listing["pagination"]['per_page'] }}"
                class="form-control"
                name="per_page"
                onchange="setQs('per_page', event.target.value)"
                min="1"
                max="{{ $listing['pagination']['total'] }}"
            >
        </div>

        <div class="col-auto data-listagem">
            <strong>
                {{ $listing['pagination']['from'] . ' - ' . $listing['pagination']['to'] }}
            </strong> de <strong>
                {{ $listing['pagination']['total'] }}
            </strong>
            (<strong>
                {{ $listing['pagination']['total_pages'] }}
            </strong> página{{ $listing['pagination']['total_pages'] > 1 ? 's' : '' }})
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
                value="{{ $listing['pagination']['current_page'] }}"
                min="1"
                max="{{ $listing['pagination']['last_page'] }}"
            />
        </div>
        <div class="col-auto">
            @if($listing['pagination']['current_page'] != 1)
                <a href="javascript:;" class="btn btn-default"
                   onclick="previousPage({{$listing['pagination']['current_page']}})">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @else
                <a href="javascript:;" class="btn btn-default disabled">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            @if($listing['pagination']['current_page'] != $listing['pagination']['last_page'])
                <a href="javascript:;" class="btn btn-default"
                   onclick="nextPage({{$listing['pagination']['current_page']}})">
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
