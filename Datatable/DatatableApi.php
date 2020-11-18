<?php


namespace Impactaweb\Datatable;


class DatatableApi
{
    public $pk = '';
    public $orderable = [];
    public $filters = [];
    public $searchable;
    public $separator = '';
    public $operators = [];

    public function __construct()
    {
        $this->operators = config('datatable.operators');
        $this->separator = config('datatable.separator');
    }

    /**
     * Add searchable field (for search with "q" querystring)
     * @param string $column
     * @return $this
     */
    public function addSearchable(string $column): self
    {
        $this->searchable[] = $column;
        return $this;
    }

    public function setSearchable(array $searchables)
    {
        $this->searchable = $searchables;
        return $this;
    }

    /**
     * @param string $primaryKey
     * @return $this
     */
    public function setId(string $primaryKey): self
    {
        $this->pk = $primaryKey;
        return $this;
    }

    public function addFilter(string $label,
                              string $column,
                              string $type = 'text',
                              $options = [],
                              $operator = [],
                              string $help = ''): self
    {
        // If empty operator, all available operators will be used
        $operator = empty($operator) ? array_keys($this->operators) : $operator;
        [
            $selectedOperator,
            $queryKey,
            $value
        ] = $this->getFilterOperator($column, $operator);

        $this->filters[] = [
            'label' => $label,
            'options' => $options,
            'column' => $column,
            'help' => $help,
            'operator' => $operator,
            'selected_operator' => $selectedOperator,
            'query' => $queryKey,
            'value' => $value,
            'type' => $type,
        ];
        return $this;
    }

    /**
     * @param array $orderables
     * @return $this
     */
    public function setOrderable(array $orderables): self
    {
        foreach ($orderables as $orderable) {
            $this->addOrderable($orderable);
        }
        return $this;
    }

    public function addOrderable(string $orderable)
    {
        if (!in_array($orderable, $this->orderable)) {
            $this->orderable[] = $orderable;
        }
        return $this;
    }

    /**
     * Return metadata to API responses
     * @return array
     */
    public function toMeta(): array
    {
        return [
            'pk' => $this->pk,
            'query_separator' => $this->separator,
            'orderable' => $this->orderable,
            'searchable' => $this->searchable,
            'filters' => $this->filters
        ];
    }

    public function getFilterOperator(string $column, $operators)
    {
        $request = request();
        if (is_array($operators)) {
            foreach ($operators as $operator) {
                $queryKey = $column . $this->separator . $operator;
                $value = $request->get($queryKey);
                if (!empty($value)) {
                    return [$operator, $queryKey, $value];
                }
            }
        }

        $operator = is_array($operators) ? $operators[0] : $operators;
        $queryKey = $column . $this->separator . $operator;
        $value = $request->get($queryKey);
        return [$operator, $queryKey, $value];
    }

}
