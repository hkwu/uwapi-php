<?php

namespace UWaterlooAPI;

/**
 * Contains API endpoint constants.
 */
abstract class Endpoints
{
    // Food Services
    const FS_MENU = 'foodservices/menu';
    const FS_NOTES = 'foodservices/notes';
    const FS_DIETS = 'foodservices/diets';
    const FS_OUTLETS = 'foodservices/outlets';
    const FS_LOCATIONS = 'foodservices/locations';
    const FS_WATCARD = 'foodservices/watcard';
    const FS_ANNOUNCEMENTS = 'foodservices/announcements';
    const FS_PRODUCTS_ID = 'foodservices/products/{product_id}';
    const FS_YEAR_WEEK_MENU = 'foodservices/{year}/{week}/menu';
    const FS_YEAR_WEEK_NOTES = 'foodservices/{year}/{week}/notes';
    const FS_YEAR_WEEK_ANNOUNCEMENTS = 'foodservices/{year}/{week}/announcements';

    // Feds
    const FEDS_EVENTS = 'feds/events';
    const FEDS_EVENTS_ID = 'feds/events/{id}';
    const FEDS_LOCATIONS = 'feds/locations';

    // courses
    const COURSES = 'courses';
    const COURSES_SUBJECT = 'courses/{subject}';
    const COURSES_ID = 'courses/{course_id}';
    const COURSES_CLASS_SCHEDULE = 'courses/{class_number}/schedule';
    const COURSES_SUBJECT_CATALOG = 'courses/{subject}/{catalog_number}';
    const COURSES_SUBJECT_CATALOG_SCHEDULE = 'courses/{subject}/{catalog_number}/schedule';
    const COURSES_SUBJECT_CATALOG_PREREQUISITES = 'courses/{subject}/{catalog_number}/prerequisites';
    const COURSES_SUBJECT_CATALOG_EXAMSCHEDULE = 'courses/{subject}/{catalog_number}/examschedule';

    // awards/scholarships
    const AWARDS_GRAD = 'awards/graduate';
    const AWARDS_UNDERGRAD = 'awards/undergraduate';

    // events
    const EVENTS = 'events';
    const EVENTS_SITE = 'events/{site}';
    const EVENTS_SITE_ID = 'events/{site}/{id}';
    const EVENTS_HOLIDAYS = 'events/holidays';

    // blogs
    const BLOGS_SITE = 'blogs/{site}';
    const BLOGS_SITE_ID = 'blogs/{site}/{id}';

    // news
    const NEWS = 'news';
    const NEWS_SITE = 'news/{site}';
    const NEWS_SITE_ID = 'news/{site}/{id}';

    // opportunities/jobs
    const OPPORTUNITIES = 'opportunities';
    const OPPORTUNITIES_SITE = 'opportunities/{site}';
    const OPPORTUNITIES_SITE_ID = 'opportunities/{site}/{id}';

    // services
    const SERVICES_SITE = 'services/{site}';

    // weather
    const WEATHER_CURRENT = 'weather/current';

    // terms
    const TERMS_LIST = 'terms/list';
    const TERMS_TERM_COURSES = 'terms/{term}/courses';
    const TERMS_TERM_EXAMS = 'terms/{term}/examschedule';
    const TERMS_TERM_SUBJECT_SCHEDULE = 'terms/{term}/{subject}/schedule';
    const TERMS_TERM_SUBJECT_CATALOG_SCHEDULE = 'terms/{term}/{subject}/{catalog_number}/schedule';
    const TERMS_TERM_ENROLLMENT = 'terms/{term}/enrollment';
    const TERMS_TERM_SUBJECT_ENROLLMENT = 'terms/{term}/{subject}/enrollment';
    const TERMS_TERM_INFOSESSIONS = 'terms/{term}/infosessions';

    // resources
    const RESOURCES_TUTORS = 'resources/tutors';
    const RESOURCES_INFOSESSIONS = 'resources/infosessions';
    const RESOURCES_GOOSEWATCH = 'resources/goosewatch';
    const RESOURCES_SUNSHINELIST = 'resources/sunshinelist';

    // definitions and codes
    const CODES_UNITS = 'codes/units';
    const CODES_TERMS = 'codes/terms';
    const CODES_GROUPS = 'codes/groups';
    const CODES_SUBJECTS = 'codes/subjects';
    const CODES_INSTRUCTIONS = 'codes/instructions';

    // building
    const BUILDINGS_LIST = 'buildings/list';
    const BUILDINGS_CODE = 'buildings/{building_code}';
    const BUILDINGS_BUILDING_ROOM_COURSES = 'buildings/{building}/{room}/courses';
    const BUILDINGS_CODE_ACCESSPOINTS = 'buildings/{building_code}/accesspoints';
    const BUILDINGS_CODE_VENDINGMACHINES = 'buildings/{building_code}/vendingmachines';

    // points of interest
    const POI_ATMS = 'poi/atms';
    const POI_GREYHOUND = 'poi/greyhound';
    const POI_HELPLINES = 'poi/helplines';
    const POI_LIBRARIES = 'poi/libraries';
    const POI_PHOTOSPHERES = 'poi/photospheres';
    const POI_DEFIBRILLATORS = 'poi/defibrillators';
    const POI_CONSTRUCTIONSITES = 'poi/constructionsites';
    const POI_ACCESSIBLEENTRANCES = 'poi/accessibleentrances';
    const POI_VISITORINFORMATION = 'poi/visitorinformation';

    // parking
    const PARKING_WATPARK = 'parking/watpark';
    const PARKING_LOTS_METER = 'parking/lots/meter';
    const PARKING_LOTS_PERMIT = 'parking/lots/permit';
    const PARKING_LOTS_VISITOR = 'parking/lots/visitor';
    const PARKING_LOTS_SHORTTERM = 'parking/lots/shortterm';
    const PARKING_LOTS_ACCESSIBLE = 'parking/lots/accessible';
    const PARKING_LOTS_MOTORCYCLE = 'parking/lots/motorcycle';

    // transit
    const TRANSIT_GRT = 'transit/grt';
    const TRANSIT_GRT_STOPS = 'transit/grt/stops';

    // people directory search
    const DIRECTORY_ID = 'directory/{user_id}';

    // API
    const API_USAGE = 'api/usage';
    const API_SERVICES = 'api/services';
    const API_METHODS = 'api/methods';
    const API_VERSIONS = 'api/versions';
    const API_CHANGELOG = 'api/changelog';

    // server
    const SERVER_TIME = 'server/time';
    const SERVER_CODES = 'server/codes';
}
