<?php

namespace App\Models;

class ResponseInfo
{
    /**
     * Response info model.
     */
    public function __construct(
        public readonly int $count,
        public readonly int $pages,
        public readonly ?string $next = null,
        public readonly ?string $prev = null,
    ) {
        //
    }
}
