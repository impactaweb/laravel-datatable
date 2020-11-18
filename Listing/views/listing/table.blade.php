@php

    function getRow($row, $field, $map) {
        if (isset($map[$field])) {
            return $map[$field]($row);
        }
        return $row[$field];
    }

    function getOrder($field) {
        $request = request();
        $currentOrder = $request->get('ord', '');
        $currentDir = mb_strtoupper($request->get('dir', ''));
        if ($field != $currentOrder) {
            return null;
        }

        return $currentDir === 'ASC' ? 'order-desc' : 'order-asc';
    }

@endphp

<table class="table table-striped table-hover table-sm"
       id="listagemTable"
       data-redir="">
    <thead>
    <tr>
        @if($listing["checkbox"] ?? true)
            <th scope="col" class="border-top-0">
                <input type="checkbox" name="checkbox-listing">
            </th>
        @endif

        @foreach($listing["columns"] ?? [] as $field => $label)
            <th scope="col" class="border-top-0">
                @if(in_array($field, $listing["orderable"] ?? []))
                    <a class="text-primary {{getOrder($field)}}"
                       onclick='setOrder("{{$field}}")'
                       href="javascript:;">
                        {{$label}}
                    </a>
                @else
                    {{$label}}
                @endif
            </th>
        @endforeach
    </tr>
    </thead>

    <tbody>
    @foreach($listing["data"] ?? [] as $row)
        <tr>
            @if($listing["checkbox"] ?? true)
                <td>
                    <input type="checkbox" name="item[]" class="listing-checkboxes"
                           value="{{$row[$listing['pk'] ?? ''] ?? ''}}">
                </td>
            @endif
            @foreach($listing["columns"] ?? [] as $field => $label)
                <td>{!! getRow($row, $field, $listing["map"] ?? []) !!}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table><?php
