<?php

namespace App\Models;

/**
 * EpisodesResponse model.
 */
class EpisodesResponse extends RamResponse
{
    /**
     * @param  Episode[]  $results
     */
    public function __construct(
        public readonly ResponseInfo $info,
        public readonly array $results,
    ) {
        //
    }
}
