<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * CharacterController.
 */
class CharacterController extends RmoController
{
    const FILTERS = ['name', 'status', 'species', 'type', 'gender'];

    /**
     * Retrieve paginated characters and render characters view.
     */
    public function showAll(Request $request): View|Factory
    {
        $pagedResponse = $this->pagedResponse;
        $page = $this->getPage($request);
        $filters = $this->getFilters($request);

        try {
            $pagedResponse = $this->rickAndMortyService->getCharacters($page, $filters);
        } catch (RequestException|ConnectionException) {
            Log::error('Failed to retrieve characters!');
        }

        return view('characters', compact('pagedResponse', 'page', 'filters'));
    }

    /**
     * Retrieve single Character by ID and render character detail view.
     */
    public function showDetail(int $id): View|Factory
    {
        try {
            $character = $this->rickAndMortyService->getCharacter($id);
        } catch (RequestException|ConnectionException) {
            abort(404); // Or handle the exception as needed
        }

        $isFavourite = $this->isFavourite($id);

        return view('character', compact('character', 'isFavourite'));
    }

    /**
     * Provide download of Character detail view in PDF.
     */
    public function exportToPdf(int $id): Response
    {
        $character = null;

        try {
            $character = $this->rickAndMortyService->getCharacter($id);
        } catch (RequestException) {
            abort(404); // Or handle the exception as needed
        }

        $pdf = PDF::loadView('character', compact('character'));

        return $pdf->download($character->name.'.pdf');
    }

    public function getEntityType(): int
    {
        return self::CHARACTER_ENT_TYPE;
    }
}
