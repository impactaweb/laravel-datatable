<?php


namespace Impactaweb\Listing;


class Listing extends ListingApi
{
    use ListingActions;

    public $showCheckbox = true;
    public $columns = [];
    public $map = [];

    public function __construct()
    {
        $this->createDefaultActions();
        parent::__construct();
    }


    /**
     * Set map to render column, by default will render column based on pure field value
     * @param array $map
     * @return $this
     */
    public function setMap(array $map): self
    {
        foreach ($map as $column => $render) {
            $this->addMap($column, $render);
        }
        return $this;
    }

    /**
     * @param string $column
     * @param $render
     * @return $this
     */
    public function addMap(string $column, $render) {
        $this->map[$column] = $render;
        return $this;
    }

    /**
     * @param array $columns
     * @return $this
     */
    public function setColumns(array $columns): self
    {
        foreach ($columns as $column => $label) {
            $this->addColumn($column, $label);
        }
        return $this;
    }

    /**
     * @param string $column
     * @param string $label
     * @return $this
     */
    public function addColumn(string $column, string $label)
    {
        $this->columns[$column] = $label;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'pk' => $this->pk,
            'query_separator' => $this->separator,
            'orderable' => $this->orderable,
            'searchable' => $this->searchable,
            'checkbox' => $this->showCheckbox,
            'filters' => $this->filters,
            'actions' => $this->actions,
            'columns' => $this->columns,
            'map' => $this->map,
            'operators' => $this->operators,
        ];
    }
}
