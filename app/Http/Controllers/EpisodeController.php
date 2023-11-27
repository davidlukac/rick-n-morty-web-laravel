<?php

namespace App\Http\Controllers;

use App\Services\RickAndMortyApiService;
use FanbaseApiClient\Api\FavouriteApi;
use FanbaseApiClient\Api\ReviewApi;
use FanbaseApiClient\ApiException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * EpisodeController.
 */
class EpisodeController extends RmoController
{
    const FILTERS = ['name', 'episode'];

    public function __construct(
        RickAndMortyApiService $rickAndMortyService,
        FavouriteApi $favouriteApi,
        protected readonly ReviewApi $reviewApi,
    ) {
        parent::__construct($rickAndMortyService, $favouriteApi);
    }

    /**
     * Retrieve paginated episodes and render episodes view.
     */
    public function showAll(Request $request): View|Factory
    {
        $pagedResponse = $this->pagedResponse;
        $page = $this->getPage($request);
        $filters = $this->getFilters($request);

        try {
            $pagedResponse = $this->rickAndMortyService->getEpisodes($page, $filters);
        } catch (RequestException|ConnectionException) {
            Log::error('Failed to retrieve characters!');
        }

        return view('episodes', compact('pagedResponse', 'page', 'filters'));
    }

    /**
     * Retrieve episode by ID and render episode detail view.
     */
    public function showDetail(int $id): View|Factory
    {
        try {
            $episode = $this->rickAndMortyService->getEpisode($id);
        } catch (RequestException|ConnectionException) {
            abort(404);
        }

        $isFavourite = $this->isFavourite($id);

        $myReview = null;
        $myRating = null;

        try {
            $review = $this->reviewApi->reviewControllerFindOne($id);
            $myReview = $review->getText();
            $myRating = $review->getRating();
        } catch (ApiException $e) {
            // Silently ignore and log as this is not critical functionality.
            Log::error('Failed to retrieve review of episode ID '.$id.': '.$e->getMessage());
        }

        return view('episode', compact('episode', 'isFavourite', 'myReview', 'myRating'));
    }

    public function getEntityType(): int
    {
        return self::EPISODE_ENT_TYPE;
    }
}
