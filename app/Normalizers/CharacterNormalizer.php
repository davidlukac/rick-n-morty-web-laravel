<?php

namespace App\Normalizers;

use App\Models\Character;
use App\Tools\UrlHelper;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Custom Character (de)normalizer.
 */
class CharacterNormalizer implements DenormalizerInterface
{
    const EPISODE_PREFIX = 'episode';

    public function __construct(
        private readonly ObjectNormalizer $normalizer,
    ) {
        //
    }

    /**
     * Implements custom denormalization - extracts episode IDs from URLs.
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?Character
    {
        if (isset($data[self::EPISODE_PREFIX])) {
            $data[self::EPISODE_PREFIX] = array_map(function ($url) {
                return UrlHelper::extractPrefixedId($url, self::EPISODE_PREFIX);
            }, $data[self::EPISODE_PREFIX]);
        }

        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Character::class;
    }
}
