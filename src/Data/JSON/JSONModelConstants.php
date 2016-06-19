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
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const LOGO = 'logo';

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

    // outlets
    const HAS_BREAKFAST = 'has_breakfast';
    const HAS_LUNCH = 'has_lunch';
    const HAS_DINNER = 'has_dinner';

    // locations
    const BUILDING = 'building';
    const DESCRIPTION = 'description';
    const NOTICE = 'notice';
    const IS_OPEN_NOW = 'is_open_now';
    const OPENING_HOURS = 'opening_hours';
    const SUNDAY = 'sunday';
    const MONDAY = 'monday';
    const TUESDAY = 'tuesday';
    const WEDNESDAY = 'wednesday';
    const THURSDAY = 'thursday';
    const FRIDAY = 'friday';
    const SATURDAY = 'saturday';
    const SPECIAL_HOURS = 'special_hours';
    const DATES_CLOSED = 'dates_closed';
    const IS_24_HRS = 'is_24_hrs';
    const ADDITIONAL = 'additional';
    const OPENING_HOUR = 'opening_hour';
    const CLOSING_HOUR = 'closing_hour';
    const IS_CLOSED = 'is_closed';
    
    // WatCard
    const VENDOR_ID = 'vendor_id';
    const VENDOR_NAME = 'vendor_name';
    const ADDRESS = 'address';
    const PHONE_NUMBER = 'phone_number';
}
