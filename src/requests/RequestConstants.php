<?php

namespace UWaterlooAPI\Requests;

class RequestConstants
{
    const BASE_API_URL = 'https://api.uwaterloo.ca/v2/';

    // food services
    const FS_MENU = 'foodservices/menu';
    const FS_NOTES = 'foodservices/notes';
    const FS_DIETS = 'foodservices/diets';
    const FS_OUTLETS = 'foodservices/outlets';
    const FS_LOCATIONS = 'foodservices/locations';
    const FS_WATCARD = 'foodservices/watcard';
    const FS_ANNOUNCEMENTS = 'foodservices/announcements';
    const FS_PRODUCTS = 'foodservices/products/%d';
    const FS_MENU_YW = 'foodservices/%d/%d/menu';
    const FS_NOTES_YW = 'foodservices/%d/%d/notes';
    const FS_ANNOUNCEMENTS_YW = 'foodservices/%d/%d/announcements';
}
