<?php

namespace UWaterlooAPI\Utils;

/**
 * Contains some utility methods for handling array data.
 */
class ArrayUtil
{
    /**
     * Recursively traverses an array and returns a deeply
     *   nested value specified by an array of keys.
     *
     * @param array $array The array to get the value from
     * @param array $keys  The keys to traverse through
     *
     * @return mixed The nested value specified by $keys. Returns null when traversal cannot continue
     */
    public static function getVal(array $array, array $keys)
    {
        foreach ($keys as $key) {
            if (!isset($array[$key])) {
                return;
            }

            $array = $array[$key];
        }

        return $array;
    }
}
