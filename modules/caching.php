<?php
/**
* API Request Caching
*
*  http://www.kevinleary.net/api-request-caching-json-php/
*
*  Use server-side caching to store API request's as JSON at a set
*  interval, rather than each pageload.
*
* @arg Argument description and usage info
*/

namespace JoshEllis\Pins\Caching;

use JoshEllis\Pins\ApiRequest;

function json_cached_api_results( $access_token, $cache_file = NULL, $expires = NULL ) {

    if( !$cache_file ) $cache_file = dirname(__FILE__) . '/api-cache.json';
    if( !$expires ) {
        $expires = time() - 2*60*60;
    } else {
        $expires = time() - $expires;
    }

    if( !file_exists($cache_file) ) die("Cache file is missing: $cache_file");

    // Check that the file is older than the expire time and that it's not empty
    if ( filectime($cache_file) < $expires || file_get_contents($cache_file)  == '' ) {

        // File is too old, refresh cache
        $json_results = ApiRequest\get_pinterest_feed($access_token);
        // TODO More robust error handling if request times out...
        file_put_contents($cache_file, $json_results);

    } else {
        // Fetch cache
        $json_results = file_get_contents($cache_file);
        $request_type = 'JSON';
    }

    return json_decode($json_results);

}
