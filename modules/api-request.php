<?php
namespace JoshEllis\Pins\ApiRequest;

function get_pinterest_feed($access_token) {
  $ctx = stream_context_create([
      'http' => [
        'timeout' => 1
      ]
    ]
  );
  $response = file_get_contents('https://api.pinterest.com/v1/me/pins/?access_token=' . $access_token . '&fields=note%2Cimage%2Clink%2Curl', false, $ctx);
  return $response;
}
