<?php

namespace App\Models;

use App\Tools\UrlHelper;

/**
 * NamedUrl model.
 */
class NamedUrl
{
    public function __construct(
        public readonly string $name,
        protected readonly string $url,
    ) {
    }

    /**
     * Extract numeric ID from entity URL.
     *
     * @return ?int
     */
    public function getId(): ?int
    {
        return UrlHelper::extractId($this->url);
    }
}
