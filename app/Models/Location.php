<?php

namespace App\Models;

/**
 * Location model.
 */
class Location
{
    /**
     * @param  int[]  $residents
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $type,
        public readonly string $dimension,
        public readonly array $residents,
        public readonly string $url,
        public readonly string $created,
    ) {
        //
    }
}
