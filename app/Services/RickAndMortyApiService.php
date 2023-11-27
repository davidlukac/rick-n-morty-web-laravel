<?php

namespace App\Services;

use App\Models\Character;
use App\Models\CharactersResponse;
use App\Models\CharactersResponseFactory;
use App\Models\Episode;
use App\Models\EpisodesResponse;
use App\Models\EpisodesResponseFactory;
use App\Models\Location;
use App\Models\LocationsResponse;
use App\Models\LocationsResponseFactory;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RickAndMortyApiService
{
    private const CHARACTER_PATH = 'character';

    private const LOCATION_PATH = 'location';

    private const EPISODE_PATH = 'episode';

    /**
     * Rick and Morty API client.
     */
    public function __construct(protected readonly string $endpoint)
    {
        //
    }

    /**
     * Retrieve paginated characters.
     *
     * @param  array<string, string>  $filters
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getCharacters(int $page = 1, array $filters = []): CharactersResponse
    {
        $character_endpoint = $this->endpoint.'/'.RickAndMortyApiService::CHARACTER_PATH;
        $query = array_merge(compact('page'), $filters);

        try {
            $response = Http::timeout(10)->retry(3, 500)->get($character_endpoint, $query);
        } catch (ConnectionException $e) {
            Log::error('Failed to connect to the API: '.$e->getMessage());
            throw $e;
        }

        return CharactersResponseFactory::createFromJson($response->throw()->body());
    }

    /**
     * Retrieve single Character.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getCharacter(int $id): Character
    {
        $character_endpoint = $this->endpoint.'/'.RickAndMortyApiService::CHARACTER_PATH.'/'.$id;

        try {
            $response = Http::timeout(10)->retry(3, 500)->get($character_endpoint, []);
        } catch (ConnectionException $e) {
            Log::error('Failed to connect to the API: '.$e->getMessage());
            throw $e;
        }

        return CharactersResponseFactory::createSingleFromJson($response->throw()->body());
    }

    /**
     * Retrieve paginated locations.
     *
     * @param  array<string, string>  $filters
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getLocations(int $page = 1, array $filters = []): LocationsResponse
    {
        $location_endpoint = $this->endpoint.'/'.RickAndMortyApiService::LOCATION_PATH;
        $query = array_merge(compact('page'), $filters);

        try {
            $response = Http::timeout(10)->retry(3, 500)->get($location_endpoint, $query);
        } catch (ConnectionException $e) {
            Log::error('Failed to connect to the API: '.$e->getMessage());
            throw $e;
        }

        return LocationsResponseFactory::createFromJson($response->throw()->body());
    }

    /**
     * Retrieve single location.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getLocation(int $id): Location
    {
        $location_endpoint = $this->endpoint.'/'.RickAndMortyApiService::LOCATION_PATH.'/'.$id;

        try {
            $response = Http::timeout(10)->retry(3, 500)->get($location_endpoint, []);
        } catch (ConnectionException $e) {
            Log::error('Failed to connect to the API: '.$e->getMessage());
            throw $e;
        }

        return LocationsResponseFactory::createSingleFromJson($response->throw()->body());
    }

    /**
     * Retrieve paginated episodes.
     *
     * @param  array<string, string>  $filters
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEpisodes(int $page = 1, array $filters = []): EpisodesResponse
    {
        $episodes_endpoint = $this->endpoint.'/'.RickAndMortyApiService::EPISODE_PATH;
        $query = array_merge(compact('page'), $filters);

        try {
            $response = Http::timeout(10)->retry(3, 500)->get($episodes_endpoint, $query);
        } catch (ConnectionException $e) {
            Log::error('Failed to connect to the API: '.$e->getMessage());
            throw $e;
        }

        return EpisodesResponseFactory::createFromJson($response->throw()->body());
    }

    /**
     * Retrieve single episode.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEpisode(int $id): Episode
    {
        $episodes_endpoint = $this->endpoint.'/'.RickAndMortyApiService::EPISODE_PATH.'/'.$id;

        try {
            $response = Http::timeout(10)->retry(3, 500)->get($episodes_endpoint, []);
        } catch (ConnectionException $e) {
            Log::error('Failed to connect to the API: '.$e->getMessage());
            throw $e;
        }

        return EpisodesResponseFactory::createSingleFromJson($response->throw()->body());
    }
}
