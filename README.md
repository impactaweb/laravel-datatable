# Laravel Datatable

This package is a helper to create "hybrid" datatables (for blade or for api responses).

## Installation

This package use another package (eloquent search)
https://github.com/impactaweb/eloquent-search

Just modify your composer.json with new VCS:

```
"repositories": [  
    ... 
    {  
        "type": "vcs",  
        "url": "git@github.com:impactaweb/eloquent-search.git"  
  },  
    {  
        "type": "vcs",  
        "url": "git@github.com:impactaweb/laravel-datatable.git"  
  }  
   ...
]
```

```composer require impactaweb/eloquent-search```
```composer require impactaweb/laravel-datatable```

And publish vendor files:

```php artisan vendor:publish --tag=public --force```

## Package Overview

Let's start with a basic example, you supposedly need to create a Clients datatable.
The flow to generate a hybrid response will be like this:

### The Collection

```php
class ClientCollection extends HybridCollection  
{  
    public $collects = ClientResource::class;  
}
```

### The Resource

```php
class ClientResource extends JsonResource  
{  
    public function toArray($request)  
    {  
        return [  
            'id' => $this->id,  
            'nome' => $this->nome,  
            'cpf' => $this->cpf,  
            'telefone' => $this->telefone,  
            'email' => $this->email,  
        ];  
    }  
  
}
```

### The Datatable Configuration

```php
$dataTable = new Datatable();  
$dataTable  
    ->setId('id')  
    ->addMap('email', Map::email('email'))  
    ->setSearchable(['nome', 'email', 'cpf', 'id'])  
    ->setOrderable(['nome', 'email', 'id'])  
    ->setColumns([  
        'id' => 'ID',  
        'nome' => 'Nome',  
        'email' => 'Email',  
        'cpf' => 'CPF',  
        'cidade' => "Cidade"  
  ])  
    ->addFilter('Nome', 'nome', 'text', [], [])  
    ->addFilter('Celular', 'celular', 'number', [], 'contains')  
    ->addFilter('CPF', 'cpf', 'number', [], 'contains', 'Somente Números')  
    ->addFilter('Email', 'email', 'email', [], 'contains')  
    ->addFilter('Telefone', 'telefone', 'number', [], 'contains');
```

### The basic model query

```php
$source = Client::with(['cidade', 'cidade.estado'])->orderBy('nome', 'ASC');
```

### Get Array Data

```php
$data = ClientCollection::getListingData($source, $dataTable);
```

### Get Api Response

```php
$response = ClientCollection::getApiResponse($source, $dataTable);
```
