<?php
namespace JoshEllis\Pins\PinList;

use JoshEllis\Pins\Caching;

function pinterest_feed_list($access_token, $options = []){
  if (!isset($options['pins'])) { $options['pins'] = 25; }
  $options['pins'] = $options['pins'] - 1;
  if (!isset($options['img_size'])) { $options['img_size'] = NULL; }
  if (!isset($options['background_image'])) { $options['background_image'] = FALSE; }
  if (!isset($options['note'])) { $options['note'] = TRUE; }
  $object = Caching\json_cached_api_results($access_token);
  $data = $object->data;
  $html = '<ul id="pinterest-feed-list" class="pinterest-feed-list">';
  foreach ($data as $key => $pin) {
    $img_src = $pin->image->original->url;
    if ($options['img_size']) {
      $img_src = str_replace('originals', $options['img_size'], $img_src);
    }
    if ($options['background_image'] === TRUE) {
      $html .= '<li class="pinterest-list-item" style="background-image: url(' . $img_src . ')"><a target="_blank" href="' . $pin->url . '"></a>';
    } else {
      $html .= '<li class="pinterest-list-item"><a target="_blank" href="' . $pin->url . '"><img src="' . $img_src . '" alt="' . $pin->note . '"></a>';
    }
    if ($options['note'] === TRUE) {
      $html .= '<p>' . $pin->note . '</p>';
    }
    $html .= '</li>';
    if ($key === $options['pins']) {
      break;
    }
  }
  $html .= '</ul>';
  echo $html;
}
