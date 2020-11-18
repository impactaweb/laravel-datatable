<select type="select" class="form-control"
        onchange="setFilter(event.target.value, '#id_op_{{$filter['column']}}')">
        @foreach($listing['operators'] as $value => $option)
            @if(in_array($value, array_values($filter['operator'])))
                <option value="{{$value}}" @if($value == $filter['selected_operator'])selected="true"@endif>
                    {{$option}}
                </option>
            @endif
        @endforeach
</select>
