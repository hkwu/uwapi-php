<?php

namespace UWaterlooAPI\Requests;

use GuzzleHttp\Client;
use UWaterlooAPI\Data\APIModelFactory;

require __DIR__.'/../../vendor/autoload.php';

class RequestClient
{
    // API constants
    const BASE_API_URL = 'https://api.uwaterloo.ca/v2/';
    const JSON = 'json';
    const XML = 'xml';

    // food services
    const FS_MENU = 'foodservices/menu';
    const FS_NOTES = 'foodservices/notes';
    const FS_DIETS = 'foodservices/diets';
    const FS_OUTLETS = 'foodservices/outlets';
    const FS_LOCATIONS = 'foodservices/locations';
    const FS_WATCARD = 'foodservices/watcard';
    const FS_ANNOUNCEMENTS = 'foodservices/announcements';
    const FS_PRODUCTS_ID = 'foodservices/products/%s';
    const FS_YEAR_WEEK_MENU = 'foodservices/%s/%s/menu';
    const FS_YEAR_WEEK_NOTES = 'foodservices/%s/%s/notes';
    const FS_YEAR_WEEK_ANNOUNCEMENTS = 'foodservices/%s/%s/announcements';

    // Feds
    const FEDS_EVENTS = 'feds/events';
    const FEDS_EVENTS_ID = 'feds/events/%s';
    const FEDS_LOCATIONS = 'feds/locations';

    // Courses
    const COURSES = 'courses';
    const COURSES_SUBJECT = 'courses/%s';
    const COURSES_ID = 'courses/%s';
    const COURSES_CLASS_SCHEDULE = 'courses/%s/schedule';
    const COURSES_SUBJECT_CATALOG = 'courses/%s/%s';
    const COURSES_SUBJECT_CATALOG_SCHEDULE = 'courses/%s/%s/schedule';
    const COURSES_SUBJECT_CATALOG_PREREQ = 'courses/%s/%s/prerequisites';
    const COURSES_SUBJECT_CATALOG_EXAMS = 'courses/%s/%s/examschedule';

    // awards/scholarships
    const AWARDS_GRAD = 'awards/graduate';
    const AWARDS_UNDERGRAD = 'awards/undergraduate';

    // events
    const EVENTS = 'events';
    const EVENTS_SITE = 'events/%s';
    const EVENTS_SITE_ID = 'events/%s/%s';
    const EVENTS_HOLIDAYS = 'events/holidays';

    // blogs
    const BLOGS_SITE = 'blogs/%s';
    const BLOGS_SITE_ID = 'blogs/%s/%s';

    // news
    const NEWS = 'news';
    const NEWS_SITE = 'news/%s';
    const NEWS_SITE_ID = 'news/%s/%s';

    // opportunities/jobs
    const OPPORTUNITIES = 'opportunities';
    const OPPORTUNITIES_SITE = 'opportunities/%s';
    const OPPORTUNITIES_SITE_ID = 'opportunities/%s/%s';

    // services
    const SERVICES_SITE = 'services/%s';

    // weather
    const WEATHER_CURRENT = 'weather/current';

    // terms
    const TERMS_LIST = 'terms/list';
    const TERMS_TERM_COURSES = 'terms/%s/courses';
    const TERMS_TERM_EXAMS = 'terms/%s/examschedule';
    const TERMS_TERM_SUBJECT_SCHEDULE = 'terms/%s/%s/schedule';
    const TERMS_TERM_SUBJECT_CATALOG_SCHEDULE = 'terms/%s/%s/%s/schedule';
    const TERMS_TERM_ENROLLMENT = 'terms/%s/enrollment';
    const TERMS_TERM_SUBJECT_ENROLLMENT = 'terms/%s/%s/enrollment';
    const TERMS_TERM_INFOSESSIONS = 'terms/%s/infosessions';

    // resources
    const RES_TUTORS = 'resources/tutors';
    const RES_PRINTERS = 'resources/tutors';
    const RES_INFOSESSIONS = 'resources/infosessions';
    const RES_GOOSEWATCH = 'resources/goosewatch';
    const RES_SUNSHINELIST = 'resources/sunshinelist';

    // defintions and codes
    const CODES_UNITS = 'codes/units';
    const CODES_TERMS = 'codes/terms';
    const CODES_GROUPS = 'codes/groups';
    const CODES_SUBJECTS = 'codes/subjects';
    const CODES_INSTRUCTIONS = 'codes/instructions';

    // building
    const BUILDINGS_LIST = 'buildings/list';
    const BUILDINGS_CODE = 'buildings/%s';
    const BUILDINGS_BUILDING_ROOM_COURSES = 'buildings/%s/%s';
    const BUILDINGS_CODE_ACCESSPOINTS = 'buildings/%s/accesspoints';
    const BUILDINGS_CODE_VENDINGMACHINES = 'buildings/%s/vendingmachines';

    // points of interest
    const POI_ATMS = 'poi/atms';
    const POI_GREYHOUND = 'poi/greyhound';
    const POI_HELPLINES = 'poi/helplines';
    const POI_LIBRARIES = 'poi/libraries';
    const POI_PHOTOSPHERES = 'poi/photospheres';
    const POI_DEFIBRILLATORS = 'poi/defibrillators';
    const POI_CONSTRUCTIONSITES = 'poi/constructionsites';
    const POI_ACCESSIBLEENTRACNCES = 'poi/accessibleentrances';
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
    const DIRECTORY_ID = 'directory/%s';

    // API
    const API_USAGE = 'api/usage';
    const API_SERVICES = 'api/services';
    const API_METHODS = 'api/methods';
    const API_VERSIONS = 'api/versions';
    const API_CHANGELOG = 'api/changelog';

    // server
    const SERVER_TIME = 'server/time';
    const SERVER_CODES = 'server/codes';

    private $apiKey;
    private $client;
    private $format;

    public function __construct($apiKey, $format = null)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => self::BASE_API_URL,
        ]);
        $this->format = $format;
    }

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    public function getFSMenu(...$params)
    {
        return $this->translateRequest($params, [
            0 => self::FS_MENU,
            2 => self::FS_YEAR_WEEK_MENU,
        ]);
    }

    public function getFSNotes(...$params)
    {
        return $this->translateRequest($params, [
            0 => self::FS_NOTES,
            2 => self::FS_YEAR_WEEK_NOTES,
        ]);
    }

    public function getFSDiets(...$params)
    {
        return $this->translateRequest($params, [
            0 => self::FS_DIETS,
        ]);
    }

    public function getFSOutlets(...$params)
    {
        return $this->translateRequest($params, [
            0 => self::FS_OUTLETS,
        ]);
    }

    public function getFSLocations(...$params)
    {
        return $this->translateRequest($params, [
            0 => self::FS_LOCATIONS,
        ]);
    }

    public function getFSWatCard(...$params)
    {
        return $this->translateRequest($params, [
            0 => self::FS_WATCARD,
        ]);
    }

    public function getFSAnnouncements(...$params)
    {
        return $this->translateRequest($params, [
            0 => self::FS_ANNOUNCEMENTS,
            2 => self::FS_YEAR_WEEK_ANNOUNCEMENTS,
        ]);
    }

    public function getFSProducts(...$params)
    {
        return $this->translateRequest($params, [
            1 => self::FS_PRODUCTS_ID,
        ]);
    }

    /**
     * Sends a request to the API. Can take parameters to specify specific endpoints.
     *
     * @param string $endpoint The API endpoint.
     * @param array  $params   Array containing parameters to be substituted into
     *                         the request URL, in the order given.
     * @param string $format   The desired response format from the API.
     *
     * @throws \GuzzleHttp\Exception\RequestException Exception thrown when Guzzle encounters an error.
     *
     * @return \UWaterlooAPI\Data\APIModel Returns API model object.
     */
    public function makeRequest($endpoint, array $params, $format)
    {
        $response = $this->client->get($this->buildRequest($endpoint, $params, $format));
        $responseBody = $this->decodeResponseBody($response->getBody());

        return APIModelFactory::makeModel($format, $endpoint, $responseBody);
    }

    private function buildRequest($endpoint, array $params, $format)
    {
        $queryStringParams = [
            'key' => $this->apiKey,
        ];

        return vsprintf($endpoint, $params).'.'.$format.'?'.http_build_query($queryStringParams);
    }

    /**
     * @param array $params
     * @param array $endpointMap
     * @throws \BadMethodCallException
     * @return \UWaterlooAPI\Data\APIModel
     */
    private function translateRequest(array $params, array $endpointMap)
    {
        if (isset($endpointMap[count($params)])) {
            return $this->makeRequest($endpointMap[count($params)], $params, $this->format);
        } else {
            throw new \BadMethodCallException(sprintf(
                'Argument count for method call should be one of (%s), got %s arguments.',
                join(', ', array_keys($endpointMap)),
                count($params)
            ));
        }
    }

    private function decodeResponseBody($responseBody)
    {
        return (string) $responseBody;
    }
}
