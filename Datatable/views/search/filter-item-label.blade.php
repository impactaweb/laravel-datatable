<label for="id_op_{{$filter['column']}}"
       class="col-auto col-form-label text-center font-weight-bold"
       style="text-transform: capitalize;">
        <div>{{ $filter['label'] }}

        @if($filter['help'])
            <img src="/vendor/impactaweb/datatable/img/tooltip.png"
                 alt="tooltip" data-toggle="tooltip"
                 data-placement="top" class="ml-1 tooltip-icon"
                 title=""
                 data-original-title="{{$filter['help']}}">
        @endif
        </div>
</label>
