<?php

namespace App\Normalizers;

use App\Models\Episode;
use App\Tools\UrlHelper;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Custom Episode (de)normalizer.
 */
class EpisodeNormalizer implements DenormalizerInterface
{
    const CHARACTERS_FIELD = 'characters';

    const CHARACTER_PREFIX = 'character';

    public function __construct(
        private readonly ObjectNormalizer $normalizer,
    ) {
        //
    }

    /**
     * Implements custom denormalization - extracts character IDs from URLs.
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        if (isset($data[self::CHARACTERS_FIELD])) {
            $data[self::CHARACTERS_FIELD] = array_map(function ($url) {
                return UrlHelper::extractPrefixedId($url, self::CHARACTER_PREFIX);
            }, $data[self::CHARACTERS_FIELD]);
        }

        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Episode::class;
    }
}
