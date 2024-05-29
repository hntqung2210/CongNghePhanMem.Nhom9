<?php
function wn_plugin_url($path = '') {
  $url = plugins_url($path, WN_PLUGIN);
  if (is_ssl() && 'http:' == substr($url, 0, 5)) {
    $url = 'https:' . substr($url, 5);
  }
  return $url;
}
