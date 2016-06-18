<?php

namespace UWaterlooAPI\Data\JSON;

abstract class JSONModelConstants
{
    // common keys
    const META = 'meta';
    const DATA = 'data';
    
    /**
     * Food Services
     */
    const DATE = 'date';
    const DIET_TYPE = 'diet_type';
    const OUTLET_NAME = 'outlet_name';
    const OUTLET_ID = 'outlet_id';

    // menu
    const WEEK = 'week';
    const YEAR = 'year';
    const START = 'start';
    const END = 'end';
    const OUTLETS = 'outlets';
    const MENU = 'menu';
    const DAY = 'day';
    const MEALS = 'meals';
    const NOTES = 'notes';
    const BREAKFAST = 'breakfast';
    const LUNCH = 'lunch';
    const DINNER = 'dinner';
    const PRODUCT_NAME = 'product_name';
    const PRODUCT_ID = 'product_id';

    // notes
    const NOTE = 'note';
    
    // diets
    const DIET_ID = 'diet_id';
}
