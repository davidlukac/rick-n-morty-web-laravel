<?php

namespace Tests\Models;

use App\Models\NamedUrl;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class NamedUrlTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [new NamedUrl('foo', 'https://foo.com/bar/baz/1'), 1],
            [new NamedUrl('foo', 'https://foo.com/bar/baz/'), null],
            [new NamedUrl('foo', 'some_bad_url123'), null],
            [new NamedUrl('foo', 'some_bad_url/123'), 123],
            [new NamedUrl('foo', 'some_bad_url/123/456'), 456],
            [new NamedUrl('foo', 'some_bad_url/123/456/asd'), null],
            [new NamedUrl('foo', 'some_bad_url/123/456/asd/'), null],
            [new NamedUrl('foo', 'some_bad_url/123/456/'), 456],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testGetId(NamedUrl $input, ?int $expected)
    {
        $actual = $input->getId();
        $this->assertSame($expected, $actual);
    }
}
