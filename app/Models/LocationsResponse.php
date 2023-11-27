<?php

namespace App\Models;

/**
 * LocationsResponse model.
 */
class LocationsResponse extends RamResponse
{
    /**
     * @param  Location[]  $results
     */
    public function __construct(
        public readonly ResponseInfo $info,
        public readonly array $results,
    ) {
        //
    }
}
