<?php

namespace Tests\Tools;

use App\Tools\UrlHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class UrlHelperTest extends TestCase
{
    /**
     * @return array<array<string, ?int>>
     */
    public static function extractIdDataProvider(): array
    {
        return [
            ['https://foo.com/bar/baz/1', 1],
            ['https://foo.com/bar/baz/', null],
            ['some_bad_url123', null],
            ['some_bad_url/123', 123],
            ['some_bad_url/123/456', 456],
            ['some_bad_url/123/456/asd', null],
            ['some_bad_url/123/456/asd/', null],
            ['some_bad_url/123/456/', 456],
        ];
    }

    #[DataProvider('extractIdDataProvider')]
    public function testExtractId(string $input, ?int $expected)
    {
        $actual = UrlHelper::extractId($input);
        $this->assertSame($expected, $actual);
    }

    public static function extractPrefixedIdDataProvider(): array
    {
        return [
            ['https://foo.com/bar/baz/1', '', 1],
            ['https://foo.com/bar/baz/1', 'baz', 1],
            ['https://foo.com/bar/baz/1', 'bar/baz', 1],
            ['https://foo.com/bar/baz/1/', 'bar/baz', 1],
            ['https://foo.com/bar/baz/', 'baz', null],
            ['https://foo.com/baz/', 'baz', null],
            ['https://foo.com/baz/123', 'baz', 123],
            ['some_bad_url123', '123', null],
            ['some_bad_url/123', '', 123],
            ['some_bad_url/123', 'url', null],
            ['some_bad/url/123', 'url', 123],
            ['some_bad/url/123/', 'url', 123],
            ['some_bad_url/123/456', '123', 456],
            ['some_bad_url/123/456/asd', '456', null],
            ['some_bad_url/123/456/asd/', '456', null],
            ['some_bad_url/123/456/', '123', 456],
        ];
    }

    #[DataProvider('extractPrefixedIdDataProvider')]
    public function testExtractPrefixedId(string $input, string $prefix, ?int $expected)
    {
        $actual = UrlHelper::extractPrefixedId($input, $prefix);
        $this->assertSame($expected, $actual);
    }
}
