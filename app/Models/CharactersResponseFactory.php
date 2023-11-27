<?php

namespace App\Models;

/**
 * Deserialization Character factory for list or single response.
 */
class CharactersResponseFactory extends RamDtoFactory
{
    public static function createFromJson(string $json): CharactersResponse
    {
        self::init();

        return self::$serializer->deserialize($json, CharactersResponse::class, 'json');
    }

    public static function createSingleFromJson(string $json): Character
    {
        self::init();

        return self::$serializer->deserialize($json, Character::class, 'json');
    }
}
