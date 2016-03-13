<?php
/*
Plugin Name: Pinterest API Feed
Description: Get some pins, show some pins
Author: Josh Ellis
Version: 0.0.1
Author URI: http://iamjoshellis.com/

License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

namespace JoshEllis\Pins;

function load_modules() {
  foreach (glob(__DIR__ . '/modules/*.php') as $file) {
    require_once $file;
  }
}
add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules', 100);
