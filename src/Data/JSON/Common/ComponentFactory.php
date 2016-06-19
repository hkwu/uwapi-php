<?php

namespace UWaterlooAPI\Data\JSON\Common;

abstract class ComponentFactory
{
    /**
     * Builds the given component using the first element of the given array as the data input.
     *
     * @param array $data
     * @param string $component
     * @return \UWaterlooAPI\Data\JSON\Common\Components\BaseComponent|null
     */
    public static function buildComponent(array $data, $component)
    {
        return empty($data) ? null : new $component(reset($data));
    }
}
