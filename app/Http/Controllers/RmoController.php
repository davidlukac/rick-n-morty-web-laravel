<?php

namespace App\Http\Controllers;

use App\Models\CharactersResponse;
use App\Models\ResponseInfo;
use App\Services\RickAndMortyApiService;
use FanbaseApiClient\Api\FavouriteApi;
use FanbaseApiClient\ApiException;
use FanbaseApiClient\Model\CheckFavouriteDto;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

abstract class RmoController extends Controller
{
    const FILTERS = self::FILTERS;

    // Retrieve entity types dynamically if needed.
    const LOCATION_ENT_TYPE = 1;

    const EPISODE_ENT_TYPE = 2;

    const CHARACTER_ENT_TYPE = 3;

    protected readonly ResponseInfo $responseInfo;

    protected readonly CharactersResponse $pagedResponse;

    /**
     * Abstract Controller base for Rick and Morty, providing helper functions.
     */
    public function __construct(
        protected readonly RickAndMortyApiService $rickAndMortyService,
        protected readonly FavouriteApi $favouriteApi
    ) {
        // Initialize paged empty response.
        $this->responseInfo = new ResponseInfo(0, 0);
        $this->pagedResponse = new CharactersResponse($this->responseInfo, []);
    }

    /**
     * Retrieve paginated entities and render table view.
     */
    abstract public function showAll(Request $request): View|Factory;

    /**
     * Retrieve single entity by ID and render entity detail view.
     */
    abstract public function showDetail(int $id): View|Factory;

    /**
     * Return entity type constant for specific implementation.
     */
    abstract protected function getEntityType(): int;

    /**
     * Retrieve filters array from request based on defined self::FILTERS.
     *
     * @return array<string, string>
     */
    protected function getFilters(Request $request): array
    {
        $filters = [];

        foreach ($this::FILTERS as $filter) {
            $filterValue = $request->input($filter, null);
            if ($filterValue != null && trim($filterValue) != '') {
                $filters[$filter] = $filterValue;
            }
        }

        return $filters;
    }

    /**
     * Get numerical page representation if present in the request.
     */
    protected function getPage(Request $request): int
    {
        $page = 1;

        if (is_numeric($request->input('page', 1))) {
            $page = (int) $request->input('page', 1);
        }

        return $page;
    }

    protected function isFavourite(int $id): bool
    {
        $isFavourite = false;

        try {
            $checkDto = new CheckFavouriteDto();
            $checkDto->setEntityId($id);
            $checkDto->setEntityTypeId($this->getEntityType());
            $isFavourite = $this->favouriteApi->favouriteControllerIsFavourited($checkDto);
        } catch (ApiException $e) {
            // Silently ignore and log as this is not critical functionality.
            Log::error('Failed to check if entity '.$id.'is favourite: '.$e->getMessage());
        }

        return $isFavourite;
    }
}
