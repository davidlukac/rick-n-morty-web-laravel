<?php

namespace App\Models;

/**
 * Character model.
 */
class Character
{
    /**
     * @param  int[]  $episode
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $status,
        public readonly string $species,
        public readonly string $type,
        public readonly string $gender,
        public readonly NamedUrl $origin,
        public readonly NamedUrl $location,
        public readonly string $image,
        public readonly array $episode,
        public readonly string $url,
        public readonly string $created,
    ) {
        //
    }
}
