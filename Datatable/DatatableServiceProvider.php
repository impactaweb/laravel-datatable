<?php


namespace Impactaweb\Datatable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class DatatableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Config
        $this->mergeConfigFrom(__DIR__ . '/config/datatable.php', 'datatable');

        // Views
        $this->loadViewsFrom(__DIR__ . '/views', 'datatable');

        // Publish config
        $this->publishes([__DIR__ . '/config/datatable.php' => config_path('datatable.php'),], 'config');

        // Publish src (static)
        $this->publishes([dirname(__DIR__) . '/dist' => public_path('vendor/impactaweb/datatable'),], 'public');

        // Builder
        Builder::macro('toListing', function (Request $request, array $listingData) {

            $searchable = $listingData['searchable'] ?? [];
            $orderable = $listingData['orderable'] ?? [];
            $filters = $listingData['filters'] ?? [];

            $builder = $this->where(function ($q) use ($filters, $searchable, $orderable, $request) {

                // Mapeia todas as propriedades column dos filters
                $queryable = array_map(function ($field) {
                    return $field['column'];
                }, $filters);

                // Advanced Search
                if (!empty($queryable)) {
                    $parameters = $request->all();
                    $activeQueries = [];
                    foreach ($parameters as $query => $value) {
                        if ($value == '' || $value == null) {
                            continue;
                        }
                        $activeQueries[$query] = $value;
                    }
                    $q->searchQueryString($activeQueries, $queryable);
                }

                // Basic Search
                $search = $request->get('q', '');
                if (!empty($search)) {
                    $q->searchText($search, $searchable);
                }
            });

            // Ordering
            $orderDir = Str::upper($request->get('dir'));
            $orderBy = $request->get('ord');
            if (in_array($orderBy, $orderable)) {
                $builder->getQuery()->orders = null;
                $builder->orderBy($orderBy, $orderDir);
            }

            // Paginate
            $default = config('datatable.per_page', 20);
            $perPage = $request->get('per_page', $default);
            $perPage = $perPage > 200 ? 200 : $perPage;
            return $builder->paginate($perPage);
        });
    }
}
