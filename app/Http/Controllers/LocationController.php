<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * LocationController.
 */
class LocationController extends RmoController
{
    const FILTERS = ['name', 'type', 'dimension'];

    /**
     * Retrieve paginated locations and render locations view.
     */
    public function showAll(Request $request): View|Factory
    {
        $pagedResponse = $this->pagedResponse;
        $page = $this->getPage($request);
        $filters = $this->getFilters($request);

        try {
            $pagedResponse = $this->rickAndMortyService->getLocations($page, $filters);
        } catch (RequestException|ConnectionException) {
            Log::error('Failed to retrieve characters!');
        }

        return view('locations', compact('pagedResponse', 'page', 'filters'));
    }

    /**
     * Retrieve single location by ID and render location detail.
     */
    public function showDetail(int $id): View|Factory
    {
        try {
            $location = $this->rickAndMortyService->getLocation($id);
        } catch (RequestException|ConnectionException) {
            abort(404);
        }

        $isFavourite = $this->isFavourite($id);

        return view('location', compact('location', 'isFavourite'));
    }

    public function getEntityType(): int
    {
        return self::LOCATION_ENT_TYPE;
    }
}
