<?php

namespace UWaterlooAPI\Data\JSON;

abstract class JSONModelConstants
{
    // common keys
    const META = 'meta';
    const DATA = 'data';

    /**
     * Food Services.
     */
    const DATE = 'date';
    const DIET_ID = 'diet_id';
    const DIET_TYPE = 'diet_type';
    const OUTLET_NAME = 'outlet_name';
    const OUTLET_ID = 'outlet_id';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const LOGO = 'logo';
    const PRODUCT_NAME = 'product_name';
    const PRODUCT_ID = 'product_id';

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

    // notes
    const NOTE = 'note';

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

    // announcements
    const AD_TEXT = 'ad_text';

    // products
    const INGREDIENTS = 'ingredients';
    const SERVING_SIZE = 'serving_size';
    const SERVING_SIZE_ML = 'serving_size_ml';
    const SERVING_SIZE_G = 'serving_size_g';
    const CALORIES = 'calories';
    const TOTAL_FAT_G = 'total_fat_g';
    const TOTAL_FAT_PERCENT = 'total_fat_percent';
    const FAT_SATURATED_G = 'fat_saturated_g';
    const FAT_SATURATED_PERCENT = 'fat_saturated_percent';
    const FAT_TRANS_G = 'fat_trans_g';
    const FAT_TRANS_PERCENT = 'fat_trans_percent';
    const CHOLESTEROL_MG = 'cholesterol_mg';
    const SODIUM_MG = 'sodium_mg';
    const SODIUM_PERCENT = 'sodium_percent';
    const CARBO_G = 'carbo_g';
    const CARBO_PERCENT = 'carbo_percent';
    const CARBO_FIBRE_G = 'carbo_fibre_g';
    const CARBO_FIBRE_PERCENT = 'carbo_fibre_percent';
    const CARBO_SUGARS_G = 'carbo_sugars_g';
    const PROTEIN_G = 'protein_g';
    const VITAMIN_A_PERCENT = 'vitamin_a_percent';
    const VITAMIN_C_PERCENT = 'vitamin_c_percent';
    const CALCIUM_PERCENT = 'calcium_percent';
    const IRON_PERCENT = 'iron_percent';
    const MICRO_NUTRIENTS = 'micro_nutrients';
    const TIPS = 'tips';
}
