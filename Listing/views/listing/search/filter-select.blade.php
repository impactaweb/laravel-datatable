<select type="select" class="form-control"
        id="id_op_{{$filter['column']}}"
        data-column="{{ $filter['column'] }}"
        name="{{ $filter['query'] }}">
        @foreach($filter['options'] ?? [] as $value => $option)
            <option value="{{$value}}" @if($value == $filter['value'])selected="true"@endif>
                {{$option}}
            </option>
        @endforeach
</select>
