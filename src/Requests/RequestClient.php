<?php

namespace UWaterlooAPI\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Psr\Http\Message\StreamInterface;
use StringTemplate\Engine;
use UWaterlooAPI\Data\APIModelFactory;

require __DIR__.'/../../vendor/autoload.php';

class RequestClient
{
    // API constants
    const BASE_API_URL = 'https://api.uwaterloo.ca/v2/';
    const JSON = 'json';
    const XML = 'xml';

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

    // Courses
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
    const RESOURCES_PRINTERS = 'resources/printers';
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

    private $apiKey;
    private $format;
    private $templateEngine;
    private $client;
    private $apiMethods;

    /**
     * RequestClient constructor.
     *
     * @param string $apiKey
     * @param string $format
     */
    public function __construct($apiKey, $format = null)
    {
        $this->apiKey = $apiKey;
        $this->format = $format;
        $this->templateEngine = new Engine();
        $this->client = new Client([
            'base_uri' => self::BASE_API_URL,
        ]);

        $this->apiMethods = [
            'getFSMenu' => [
                0 => self::FS_MENU,
            ],
            'getFSNotes' => [
                0 => self::FS_NOTES,
            ],
            'getFSDiets' => [
                0 => self::FS_DIETS,
            ],
            'getFSOutlets' => [
                0 => self::FS_OUTLETS,
            ],
            'getFSLocations' => [
                0 => self::FS_LOCATIONS,
            ],
            'getFSWatCard' => [
                0 => self::FS_WATCARD,
            ],
            'getFSAnnouncements' => [
                0 => self::FS_ANNOUNCEMENTS,
            ],
            'getFSProductsId' => [
                1 => self::FS_PRODUCTS_ID,
            ],
            'getFSYearWeekMenu' => [
                2 => self::FS_YEAR_WEEK_MENU,
            ],
            'getFSYearWeekNotes' => [
                2 => self::FS_YEAR_WEEK_NOTES,
            ],
            'getFSYearWeekAnnouncements' => [
                2 => self::FS_YEAR_WEEK_ANNOUNCEMENTS,
            ],
            'getFedsEvents' => [
                0 => self::FEDS_EVENTS,
            ],
            'getFedsEventsId' => [
                1 => self::FEDS_EVENTS_ID,
            ],
            'getFedsLocations' => [
                0 => self::FEDS_LOCATIONS,
            ],
            'getCourses' => [
                0 => self::COURSES,
            ],
            'getCoursesSubject' => [
                1 => self::COURSES_SUBJECT,
            ],
            'getCoursesId' => [
                1 => self::COURSES_ID,
            ],
            'getCoursesClassSchedule' => [
                1 => self::COURSES_CLASS_SCHEDULE,
            ],
            'getCoursesSubjectCatalog' => [
                2 => self::COURSES_SUBJECT_CATALOG,
            ],
            'getCoursesSubjectCatalogSchedule' => [
                2 => self::COURSES_SUBJECT_CATALOG_SCHEDULE,
            ],
            'getCoursesSubjectCatalogPrerequisites' => [
                2 => self::COURSES_SUBJECT_CATALOG_PREREQUISITES,
            ],
            'getCoursesSubjectCatalogExamSchedule' => [
                2 => self::COURSES_SUBJECT_CATALOG_EXAMSCHEDULE,
            ],
            'getAwardsGrad' => [
                0 => self::AWARDS_GRAD,
            ],
            'getAwardsUndergrad' => [
                0 => self::AWARDS_UNDERGRAD,
            ],
            'getEvents' => [
                0 => self::EVENTS,
            ],
            'getEventsSite' => [
                1 => self::EVENTS_SITE,
            ],
            'getEventsSiteId' => [
                2 => self::EVENTS_SITE_ID,
            ],
            'getEventsHolidays' => [
                0 => self::EVENTS_HOLIDAYS,
            ],
            'getBlogsSite' => [
                1 => self::BLOGS_SITE,
            ],
            'getBlogsSiteId' => [
                2 => self::BLOGS_SITE_ID,
            ],
            'getNews' => [
                0 => self::NEWS,
            ],
            'getNewsSite' => [
                1 => self::NEWS_SITE,
            ],
            'getNewsSiteId' => [
                2 => self::NEWS_SITE_ID,
            ],
            'getOpportunities' => [
                0 => self::OPPORTUNITIES,
            ],
            'getOpportunitiesSite' => [
                1 => self::OPPORTUNITIES_SITE,
            ],
            'getOpportunitiesSiteId' => [
                2 => self::OPPORTUNITIES_SITE_ID,
            ],
            'getServices' => [
                1 => self::SERVICES_SITE,
            ],
            'getWeather' => [
                0 => self::WEATHER_CURRENT,
            ],
            'getTermsList' => [
                0 => self::TERMS_LIST,
            ],
            'getTermsTermCourses' => [
                1 => self::TERMS_TERM_COURSES,
            ],
            'getTermsTermExams' => [
                1 => self::TERMS_TERM_EXAMS,
            ],
            'getTermsTermSubjectSchedule' => [
                2 => self::TERMS_TERM_SUBJECT_SCHEDULE,
            ],
            'getTermsTermSubjectCatalogSchedule' => [
                3 => self::TERMS_TERM_SUBJECT_CATALOG_SCHEDULE,
            ],
            'getTermsTermEnrollment' => [
                1 => self::TERMS_TERM_ENROLLMENT,
            ],
            'getTermsTermSubjectEnrollment' => [
                2 => self::TERMS_TERM_SUBJECT_ENROLLMENT,
            ],
            'getTermInfosessions' => [
                1 => self::TERMS_TERM_INFOSESSIONS,
            ],
            'getResourcesTutors' => [
                0 => self::RESOURCES_TUTORS,
            ],
            'getResourcesPrinters' => [
                0 => self::RESOURCES_PRINTERS,
            ],
            'getResourcesInfosessions' => [
                0 => self::RESOURCES_INFOSESSIONS,
            ],
            'getResourcesGoosewatch' => [
                0 => self::RESOURCES_GOOSEWATCH,
            ],
            'getResourcesSunshineList' => [
                0 => self::RESOURCES_SUNSHINELIST,
            ],
            'getCodesUnits' => [
                0 => self::CODES_UNITS,
            ],
            'getCodesTerms' => [
                0 => self::CODES_TERMS,
            ],
            'getCodesGroups' => [
                0 => self::CODES_GROUPS,
            ],
            'getCodesSubjects' => [
                0 => self::CODES_SUBJECTS,
            ],
            'getCodesInstructions' => [
                0 => self::CODES_INSTRUCTIONS,
            ],
            'getBuildingsList' => [
                0 => self::BUILDINGS_LIST,
            ],
            'getBuildingsCode' => [
                1 => self::BUILDINGS_CODE,
            ],
            'getBuildingsBuildingRoomCourses' => [
                2 => self::BUILDINGS_BUILDING_ROOM_COURSES,
            ],
            'getBuildingsCodeAccessPoints' => [
                1 => self::BUILDINGS_CODE_ACCESSPOINTS,
            ],
            'getBuildingsCodeVendingMachines' => [
                1 => self::BUILDINGS_CODE_VENDINGMACHINES,
            ],
            'getPoiAtms' => [
                0 => self::POI_ATMS,
            ],
            'getPoiGreyhound' => [
                0 => self::POI_GREYHOUND,
            ],
            'getPoiHelplines' => [
                0 => self::POI_HELPLINES,
            ],
            'getPoiLibraries' => [
                0 => self::POI_LIBRARIES,
            ],
            'getPoiPhotospheres' => [
                0 => self::POI_PHOTOSPHERES,
            ],
            'getPoiDefibrillators' => [
                0 => self::POI_DEFIBRILLATORS,
            ],
            'getPoiConstructionSites' => [
                0 => self::POI_CONSTRUCTIONSITES,
            ],
            'getPoiAccessibleEntrances' => [
                0 => self::POI_ACCESSIBLEENTRACNCES,
            ],
            'getPoiVisitorInformation' => [
                0 => self::POI_VISITORINFORMATION,
            ],
            'getParkingWatPark' => [
                0 => self::PARKING_WATPARK,
            ],
            'getParkingLotsMeter' => [
                0 => self::PARKING_LOTS_METER,
            ],
            'getParkingLotsPermit' => [
                0 => self::PARKING_LOTS_PERMIT,
            ],
            'getParkingLotsVisitor' => [
                0 => self::PARKING_LOTS_VISITOR,
            ],
            'getParkingLotsShortTerm' => [
                0 => self::PARKING_LOTS_SHORTTERM,
            ],
            'getParkingLotsAccessible' => [
                0 => self::PARKING_LOTS_ACCESSIBLE,
            ],
            'getParkingLotsMotorcycle' => [
                0 => self::PARKING_LOTS_MOTORCYCLE,
            ],
            'getTransitGrt' => [
                0 => self::TRANSIT_GRT,
            ],
            'getTransitGrtStops' => [
                0 => self::TRANSIT_GRT_STOPS,
            ],
            'getDirectoryId' => [
                1 => self::DIRECTORY_ID,
            ],
            'getApiUsage' => [
                0 => self::API_USAGE,
            ],
            'getApiServices' => [
                0 => self::API_SERVICES,
            ],
            'getApiMethods' => [
                0 => self::API_METHODS,
            ],
            'getApiVersions' => [
                0 => self::API_VERSIONS,
            ],
            'getApiChangelog' => [
                0 => self::API_CHANGELOG,
            ],
            'getServerTime' => [
                0 => self::SERVER_TIME,
            ],
            'getServerCodes' => [
                0 => self::SERVER_CODES,
            ],
        ];
    }

    /**
     * @param string $format
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return \UWaterlooAPI\Data\APIModel|\UWaterlooAPI\Requests\AsyncWrapper
     *
     * @throws \InvalidArgumentException
     * @throws \BadMethodCallException
     */
    public function __call($name, $arguments)
    {
        if (isset($this->apiMethods[$name])) {
            switch (count($arguments)) {
                case 0:
                    return $this->translateRequest([], [], $this->apiMethods[$name]);
                case 1:
                    if (!is_array($arguments[0])) {
                        throw new \InvalidArgumentException(sprintf(
                            'Expected array for first argument to %s(), got %s.',
                            $name,
                            gettype($arguments[0])
                        ));
                    }

                    return $this->translateRequest($arguments[0], [], $this->apiMethods[$name]);
                default:
                    if (!is_array($arguments[0]) || !is_array($arguments[1])) {
                        throw new \InvalidArgumentException(sprintf(
                            'Expected array for first and second argument to %s(), got %s and %s.',
                            $name,
                            gettype($arguments[0]),
                            gettype($arguments[1])
                        ));
                    }

                    return $this->translateRequest($arguments[0], $arguments[1], $this->apiMethods[$name]);
            }
        } else {
            throw new \BadMethodCallException(sprintf('%s() is not a valid method.'));
        }
    }

    /**
     * Sends a request to the API. Can take parameters to specify specific endpoints.
     *
     * @param string $endpoint The API endpoint.
     * @param array  $params   Array containing parameters to be substituted into
     *                         the request URL, in the order given.
     * @param array  $options  Array of options for this request.
     *
     * @throws \Exception Exception thrown when options array is configured incorrectly.
     *
     * @return \UWaterlooAPI\Data\APIModel|AsyncWrapper Returns API model object, or an AsyncWrapper object if request was asynchronous.
     */
    public function makeRequest($endpoint, array $params = [], array $options = [])
    {
        $format = $this->getDefaultOption($options, 'format');
        $validFormats = [
            self::JSON,
            self::XML,
        ];

        if (!in_array($format, $validFormats, true)) {
            throw new \Exception(sprintf('Invalid format specified for request: %s.', $format));
        }

        if (isset($options['async']) && $options['async']) {
            return new AsyncWrapper(
                $this->client->getAsync($this->buildRequestURL($endpoint, $params, $format)),
                $endpoint,
                $format
            );
        } else {
            $response = $this->client->get($this->buildRequestURL($endpoint, $params, $format));
            $responseBody = $this->decodeResponseBody($response->getBody());

            return APIModelFactory::makeModel($format, $endpoint, $responseBody);
        }
    }

    /**
     * Gets a response from the promise stored inside the wrapper and builds a model from it.
     *
     * @param \UWaterlooAPI\Requests\AsyncWrapper $wrapper
     *
     * @return \UWaterlooAPI\Data\APIModel
     */
    public function getAsyncResponse(AsyncWrapper $wrapper)
    {
        return APIModelFactory::makeModel(
            $wrapper->getFormat(),
            $wrapper->getEndpoint(),
            $this->decodeResponseBody($wrapper->getPromise()->wait()->getBody())
        );
    }

    /**
     * Takes an array of endpoints to hit and their respective parameters, then sends all the requests concurrently.
     *
     * @param array $endpoints The API endpoints to hit.
     * @param array $params    The parameters to be substituted into each endpoint stub.
     *                         Should have the same keys as $endpoints.
     * @param array $options   Options to be applied to the entire batch of requests.
     *
     * @return array Array of models built using returned data for each endpoint given as input.
     *               Array keys are preserved as given in $endpoints.
     */
    public function batchRequests(array $endpoints, array $params = [], array $options = [])
    {
        $promises = [];
        $options['format'] = $this->getDefaultOption($options, 'format');

        foreach ($endpoints as $key => $endpoint) {
            $endpointParams = isset($params[$key]) ? $params[$key] : [];
            $promises[$key] = $this->client->getAsync(
                $this->buildRequestURL($endpoint, $endpointParams, $options['format'])
            );
        }

        $results = Promise\unwrap($promises);
        $models = [];

        foreach ($results as $key => $response) {
            $models[$key] = APIModelFactory::makeModel(
                $options['format'],
                $endpoints[$key],
                $this->decodeResponseBody($response->getBody())
            );
        }

        return $models;
    }

    /**
     * @param StreamInterface $responseBody
     *
     * @return string
     */
    private function decodeResponseBody(StreamInterface $responseBody)
    {
        return (string) $responseBody;
    }

    /**
     * @param array  $options
     * @param string $option
     *
     * @return mixed
     */
    private function getDefaultOption(array $options, $option)
    {
        return isset($options[$option]) ? $options[$option] : $this->$option;
    }

    /**
     * @param string $endpoint
     * @param array  $params
     * @param string $format
     *
     * @return string
     */
    private function buildRequestURL($endpoint, array $params, $format)
    {
        $queryStringParams = [
            'key' => $this->apiKey,
        ];

        return $this->templateEngine->render($endpoint, $params).'.'.$format.'?'.http_build_query($queryStringParams);
    }

    /**
     * @param array $params
     * @param array $options
     * @param array $endpointMap
     *
     * @return \UWaterlooAPI\Data\APIModel|\UWaterlooAPI\Requests\AsyncWrapper
     *
     * @throws \Exception
     */
    private function translateRequest(array $params, array $options, array $endpointMap)
    {
        if (isset($endpointMap[count($params)])) {
            return $this->makeRequest($endpointMap[count($params)], $params, $options);
        } else {
            throw new \Exception(sprintf(
                'Argument count for $params should be one of (%s), got %s arguments.',
                implode(', ', array_keys($endpointMap)),
                count($params)
            ));
        }
    }
}
