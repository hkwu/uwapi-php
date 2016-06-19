<?php

namespace UWaterlooAPI\Data\JSON\Common\Components;

class ComponentFactory
{
    /**
     * Builds the given component using the given array as the data input.
     *
     * @param array $data
     * @param string $component
     * @return \UWaterlooAPI\Data\JSON\Common\Components\BaseComponent|null
     */
    public static function buildComponent(array $data, $component)
    {
        return empty($data) ? null : new $component($data);
    }

    /**
     * Builds the given component using the first element of the given array as the data input.
     *
     * @param array $data
     * @param string $component
     * @return \UWaterlooAPI\Data\JSON\Common\Components\BaseComponent|null
     */
    public static function buildComponentArray(array $data, $component)
    {
        return empty($data) ? null : new $component(reset($data));
    }

    /**
     * Builds an array of components using the elements of the given array as the data input.
     *
     * @param array $data
     * @param string $component
     * @return \UWaterlooAPI\Data\JSON\Common\Components\BaseComponent|null
     */
    public static function buildComponents(array $data, $component)
    {
        return array_map(function ($element) use ($component) {
            return new $component($element);
        }, $data);
    }
}
