<?php

namespace App\Models;

use App\Normalizers\CharacterNormalizer;
use App\Normalizers\EpisodeNormalizer;
use App\Normalizers\LocationNormalizer;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class RamDtoFactory
{
    protected static Serializer $serializer;

    /**
     * Initialize serializers, deserializers and custom normalizers.
     */
    protected static function init(): void
    {
        $phpDocExtractor = new PhpDocExtractor();
        $typeExtractor = new PropertyInfoExtractor(
            typeExtractors: [
                new ConstructorExtractor([$phpDocExtractor]),
                $phpDocExtractor,
                new ReflectionExtractor(),
            ]
        );

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $encoders = [new JsonEncoder()];

        $objectNormalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null,
            null,
            $typeExtractor,
        );

        $normalizers = [
            new CharacterNormalizer($objectNormalizer),
            new LocationNormalizer($objectNormalizer),
            new EpisodeNormalizer($objectNormalizer),
            $objectNormalizer,
            new ArrayDenormalizer(),
        ];

        self::$serializer = new Serializer($normalizers, $encoders);
    }

    abstract public static function createFromJson(string $json): RamResponse;

    abstract public static function createSingleFromJson(string $json): object;
}
