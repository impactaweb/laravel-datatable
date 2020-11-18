<?php

namespace Impactaweb\Datatable;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HybridCollection extends ResourceCollection
{
    public $collects = '';

    public function __construct($resource)
    {
        if (empty($this->collects)) {
            throw new Exception('Collects not defined in collection');
        }
        parent::__construct($resource);
    }


    public static function getListingData(Builder $source, $listing): array
    {
        $request = request();
        $listingData = $listing->toArray();

        // Start a new collection
        $collection = self::make($source->toListing($request, $listingData));

        // Get array from collection resource
        $data = $collection->resource->toArray();

        // Transform a list of resources instances in data (array)
        $resourceData = array_map(function ($resource) use ($request) {
            return $resource->toArray($request);
        }, $data['data']);

        // create pagination array
        $paginationData = [
            'current_page' => $data['current_page'],
            'last_page' => $data['last_page'],
            'per_page' => $data['per_page'],
            'from' => $data['from'],
            'to' => $data['to'],
            'total_pages' => (int)ceil($data['total'] / $data['per_page']),
            'total' => $data['total']
        ];

        return array_merge(['data' => $resourceData, 'pagination' => $paginationData], $listingData);
    }

    public static function getApiResponse(Builder $data, $listing): JsonResponse
    {
        $request = request();
        $source = $data->toListing($request, $listing->toMeta());
        return self::make($source)
            ->additional($listing->toMeta())
            ->toResponse($request);
    }
}
