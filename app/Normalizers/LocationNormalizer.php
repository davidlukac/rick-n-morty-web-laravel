<?php

namespace App\Normalizers;

use App\Models\Location;
use App\Tools\UrlHelper;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Custom Location (de)normalizer.
 */
class LocationNormalizer implements DenormalizerInterface
{
    const RESIDENTS_FIELD = 'residents';

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
        if (isset($data[self::RESIDENTS_FIELD])) {
            $data[self::RESIDENTS_FIELD] = array_map(function ($url) {
                return UrlHelper::extractPrefixedId($url, self::CHARACTER_PREFIX);
            }, $data[self::RESIDENTS_FIELD]);
        }

        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Location::class;
    }
}
