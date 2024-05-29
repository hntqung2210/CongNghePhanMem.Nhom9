<?php

/**
 * Plugin Name: Tiện ích WebNow
 * Plugin URI: https://webnow.vn/
 * Description: Các tiện ích cần thiết cho website
 * Version: 1.0
 * Author: Sai Gon Web Co., Ltd
 * Author URI: https://webnow.vn/
 * Text Domain: wn
 */

if (!defined('ABSPATH')) {
  die('Cút!');
}

define('WN_PLUGIN', __FILE__);
define('WN_PLUGIN_SLUG', basename(dirname(__FILE__)));
define('WN_PLUGIN_BASENAME', plugin_basename(WN_PLUGIN));
define('WN_PLUGIN_NAME', trim(dirname(WN_PLUGIN_BASENAME), '/'));
define('WN_PLUGIN_DIR', untrailingslashit(dirname(WN_PLUGIN)));

require_once WN_PLUGIN_DIR . '/includes/loader.php';
require_once WN_PLUGIN_DIR . '/includes/setting-page.php';
require_once WN_PLUGIN_DIR . '/includes/utils.php';
