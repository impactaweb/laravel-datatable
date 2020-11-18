@foreach($data['filters'] ?? [] as $filter)
    @if(is_array($filter['operator']))
        <div class="row mb-3">
            <div class="col-md-3 d-inline-flex">
                @include('datatable::search.filter-item-label', ['filter' => $filter])
            </div>
            <div class="col-md-3">
                @include('datatable::search.filter-operators-select', ['data' => $data, 'filter' => $filter])
            </div>
            <div class="col-md-6">
                @if(Str::upper($filter['type'])  == 'SELECT')
                    @include('datatable::search.filter-select', ['filter'=> $filter])
                @else
                    @include('datatable::search.filter-text', ['filter'=> $filter])
                @endif
            </div>
        </div>
    @else
        <div class="row mb-3">
            <div class="col-md-3">
                @include('datatable::search.filter-item-label', ['filter' => $filter])
            </div>
            <div class="col-md-9">
                @if(Str::upper($filter['type'])  == 'SELECT')
                    @include('datatable::search.filter-select', ['filter'=> $filter])
                @else
                    @include('datatable::search.filter-text', ['filter'=> $filter])
                @endif
            </div>
        </div>
    @endif
@endforeach
