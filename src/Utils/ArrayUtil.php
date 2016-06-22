<?php

namespace UWaterlooAPI\Utils;

class ArrayUtil
{
    public static function getVal(array $array, $keys)
    {
        foreach ($keys as $key) {
            if (!isset($array[$key])) {
                return;
            }

            $array = $array[$key];
        }

        return $array;
    }

    /**
     * Filters elements from an array of associative arrays that don't contain a certain key/value pair.
     *
     * @param array $array       The array of associative arrays to filter.
     * @param mixed $prop        The key to filter by.
     * @param mixed $expectedVal The expected value which given key maps to.
     *
     * @return array The filtered array.
     */
    public static function filterByProperty(array $array, $prop, $expectedVal)
    {
        // todo handle exceptions
        return array_filter($array, function ($val, $key) use ($prop, $expectedVal) {
            return $val[$prop] === $expectedVal;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
