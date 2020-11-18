@if(!empty($listing['actions']))
    @include('listing::confirmation-modal')
    <div class="col">
        @foreach($listing['actions'] as $type => $actions)
            <button type="button" class="btn btn-lg btn-default tooltips actionButton"
                    data-name="{{ $type }}"
                    data-url="{{ $actions['url'] }}"
                    data-verb="{{ $type }}"
                    data-method="{{ $actions['method'] }}"
                    title=""
                    data-confirmation="{{ $actions['message'] }}"
                    data-toggle="tooltip"
                    data-placement="top"
                    data-original-title="{{ $actions['label'] }}">
                <i class="{{ $actions['icon'] }}"></i>
                <span class="sr-only">
                    {{$actions['label']}}
                </span>
            </button>
        @endforeach
    </div>
@endif
