<?php

namespace App\Models;

/**
 * CharactersResponse model.
 */
class CharactersResponse extends RamResponse
{
    /**
     * @param  Character[]  $results
     */
    public function __construct(
        public readonly ResponseInfo $info,
        public readonly array $results,
    ) {
        //
    }
}
