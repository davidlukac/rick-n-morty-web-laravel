<?php

namespace App\Tools;

class UrlHelper
{
    /**
     * Extract ID as int from the end of given URL string.
     *
     * "https://foo.com/bar/baz/1" -> 1
     *
     * @return ?int
     */
    public static function extractId(string $url): ?int
    {
        return self::extractPrefixedId($url);
    }

    /**
     * Extract ID as int from the end of given URL string, with a prefix as part of URL
     *
     * prefix 'baz': "https://foo.com/bar/baz/1" -> 1
     * prefix 'bar/baz': "https://foo.com/bar/baz/1" -> 1
     *
     * @return ?int
     */
    public static function extractPrefixedId(string $url, string $prefix = ''): ?int
    {
        $pattern = '(\d+)$';
        if ($prefix) {
            $pattern = '\/'.preg_quote($prefix, '/').'\/'.$pattern;
        } else {
            $pattern = '\/'.$pattern;
        }
        $pattern = '/'.$pattern.'/';
        $match = null;

        if (preg_match($pattern, rtrim($url, '/'), $matches)) {
            $match = (int) $matches[1];
        }

        return $match;
    }
}
