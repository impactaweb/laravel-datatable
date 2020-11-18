@php

    if (!function_exists('getRow')) {
        function getRow($row, $field, $map) {
            if (isset($map[$field])) {
                return $map[$field]($row);
            }
            return $row[$field];
        }
    }


    if (!function_exists('getOrder')) {
        function getOrder($field) {
            $request = request();
            $currentOrder = $request->get('ord', '');
            $currentDir = mb_strtoupper($request->get('dir', ''));
            if ($field != $currentOrder) {
                return null;
            }

            return $currentDir === 'ASC' ? 'order-desc' : 'order-asc';
        }
    }

@endphp

<table class="table table-striped table-hover table-sm"
       id="listagemTable"
       data-redir="">
    <thead>
    <tr>
        @if($data["checkbox"] ?? true)
            <th scope="col" class="border-top-0">
                <input type="checkbox" name="checkbox-listing">
            </th>
        @endif

        @foreach($data["columns"] ?? [] as $field => $label)
            <th scope="col" class="border-top-0">
                @if(in_array($field, $data["orderable"] ?? []))
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
    @foreach($data["data"] ?? [] as $row)
        <tr>
            @if($data["checkbox"] ?? true)
                <td>
                    <input type="checkbox" name="item[]" class="listing-checkboxes"
                           value="{{$row[$data['pk'] ?? ''] ?? ''}}">
                </td>
            @endif
            @foreach($data["columns"] ?? [] as $field => $label)
                <td>{!! getRow($row, $field, $data["map"] ?? []) !!}</td>
            @endforeach
        </tr>
    @endforeach
    @if(empty($data['data']))
        <tr class="empty">
            <td colspan="100%">Nenhum item encontrado</td>
        </tr>
    @endif
    </tbody>
</table><?php
