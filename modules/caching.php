<?php
namespace JoshEllis\Pins\Caching;

use JoshEllis\Pins\ApiRequest;

function api_response_cache ($access_token) {
  $cache = get_transient('pinterest_api_response');
  if(!empty($cache)) {
    echo 'cached!';
    return json_decode($cache);
  } else {
    $api_response = ApiRequest\get_pinterest_feed($access_token);
    set_transient('pinterest_api_response', $api_response, 2 * 60 * 60);
    echo 'not cached!';
    return json_decode($api_response);
  }
}
