<?php

namespace App\Models;

/**
 * Deserialization Episode factory for list or single response.
 */
class EpisodesResponseFactory extends RamDtoFactory
{
    public static function createFromJson(string $json): EpisodesResponse
    {
        self::init();

        return self::$serializer->deserialize($json, EpisodesResponse::class, 'json');
    }

    public static function createSingleFromJson(string $json): Episode
    {
        self::init();

        return self::$serializer->deserialize($json, Episode::class, 'json');
    }
}
