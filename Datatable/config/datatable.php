<?php

return [
    'operators' => [
        'contains' => 'Contém',
        'not_contains' => 'Não contém',
        'lte' => 'Menor ou igual',
        'lt' => 'Menor',
        'gte' => 'Maior ou igual',
        'gt' => 'Maior que',
        'exact' => 'Igual',
        'not_exact' => 'Diferente',
    ],
    'per_page' => 20, // Default per page value
    'separator' => '__',
    'default_actions' => [
        // Available wildcards
        // {redir} => Current route with URL encode
        // {path} => base route path
        // {id} => row id
        // {ids} => selected ids (checkbox)
        [
            'type' => 'create',
            'label' => 'Adicionar',
            'url' => "/{path}/criar?&redir={redir}",
            'icon' => 'far fa-plus-square',
            'method' => 'GET',
            'showLabel' => false
        ],
        [
            'type' => 'edit',
            'label' => 'Editar',
            'url' => "/{path}/{id}/editar?ids={ids}&redir={redir}",
            'icon' => 'far fa-edit',
            'method' => 'GET',
            'showLabel' => false,
            'message' => null
        ],
        [
            'type' => 'delete',
            'label' => 'Deletar',
            'url' => "/{path}/{id}?multiple={ids}&redir={redir}",
            'icon' => 'far fa-trash-alt',
            'method' => 'DELETE',
            'showLabel' => false,
            'message' => 'Tem certeza que deseja excluir os itens selecionados?'
        ]
    ]
];
