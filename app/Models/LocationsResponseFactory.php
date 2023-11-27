<?php

namespace App\Models;

/**
 * Deserialization Location factory for list or single response.
 */
class LocationsResponseFactory extends RamDtoFactory
{
    public static function createFromJson(string $json): LocationsResponse
    {
        self::init();

        return self::$serializer->deserialize($json, LocationsResponse::class, 'json');
    }

    public static function createSingleFromJson(string $json): Location
    {
        self::init();

        return self::$serializer->deserialize($json, Location::class, 'json');
    }
}
