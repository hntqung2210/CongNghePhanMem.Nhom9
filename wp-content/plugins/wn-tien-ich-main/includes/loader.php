<?php

add_action('admin_enqueue_scripts', function () {
  wp_enqueue_media();
  wp_enqueue_script('wp-color-picker');
  wp_enqueue_style('wp-color-picker');
});

// Custom trang login
add_action('login_head', function () {
  remove_action('login_head', 'wp_shake_js', 12);
  echo '<link rel="stylesheet" type="text/css" href="' . wn_plugin_url('/css/login.css') . '" />';
});

add_filter('login_headerurl', function ($url) {
  return 'https://webnow.vn';
});

add_filter('login_headertext', function () {
  return 'WebNow.VN - Nay Code Mai Giao';
});

function wn_add_favicon() {
  echo '<link rel="shortcut icon" href="' . wn_plugin_url('/images/admin-favicon.png') . '" />';
}
add_action('login_head', 'wn_add_favicon');
add_action('admin_head', 'wn_add_favicon');

// Xoá logo Wordpress
add_action('admin_bar_menu', function ($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');
}, 999);

// Ẩn update
function wn_remove_core_updates() {
  global $wp_version;
  return (object) array('last_checked' => time(), 'version_checked' => $wp_version,);
}
add_filter('pre_site_transient_update_core', 'wn_remove_core_updates');
add_filter('pre_site_transient_update_plugins', 'wn_remove_core_updates');
add_filter('pre_site_transient_update_themes', 'wn_remove_core_updates');

// Dùng WP 4.0
add_filter('use_block_editor_for_post', '__return_false');

// Ẩn Flatsome notice
add_action('admin_head', function () {
  echo '<style> div#flatsome-notice { display: none; } </style>';
});

add_action('admin_init', function () {
  if (is_admin() && current_user_can('activate_plugins')) {
    $list_inactive_plugins = array();
    $hide_warning = get_option(WN_PLUGIN_SLUG . '_hide_install_plugin_warning');

    if ($hide_warning !== 'on') {
      if (!is_plugin_active('seo-by-rank-math/rank-math.php')) {
        array_push($list_inactive_plugins, '<a href="https://wordpress.org/plugins/seo-by-rank-math/">Rank Math SEO</a>');
      }
      if (!is_plugin_active('wp-fastest-cache/wpFastestCache.php')) {
        array_push($list_inactive_plugins, '<a href="https://wordpress.org/plugins/wp-fastest-cache/">WP Fastest Cache</a>');
      }
      if (!is_plugin_active('smtp-mailing-queue/smtp-mailing-queue.php')) {
        array_push($list_inactive_plugins, '<a href="https://wordpress.org/plugins/smtp-mailing-queue/">SMTP Mailing Queue</a>');
      }

      if (count($list_inactive_plugins) > 0) {
        add_action('admin_notices', function () use (&$list_inactive_plugins) {
          echo '<div class="error">
                        <p>Vui lòng cài đặt và kích hoạt plugin ' . implode(', ', $list_inactive_plugins) . '.</p>
                    </div>';
        });
      }
    }
  }
});

// Preload
add_action('wp_footer', function () {
  $show_loading = get_option(WN_PLUGIN_SLUG . '_show_loading');
  if ($show_loading == 'on') {
    $logo_id = get_option(WN_PLUGIN_SLUG . '_logo_svg');
    if (!empty($logo_id)) {
      $dashoffset = get_option(WN_PLUGIN_SLUG . '_dashoffset');
      $bg = get_option(WN_PLUGIN_SLUG . '_background');
      $url = wp_get_attachment_image_url($logo_id);
      $svg = file_get_contents($url);
?>
      <div id="wn-preload"><?= $svg ?></div>
      <style>
        #wn-preload {
          background: <?= $bg ?>;
          width: 100vw;
          height: 100vh;
          position: fixed;
          top: 0;
          left: 0;
          z-index: 99999;
          color: white;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
        }

        #wn-preload svg {
          width: 40vw;
        }

        #wn-preload path {
          fill: var(--primary-color);
          stroke-miterlimit: 10;
          stroke-width: 1px;
          stroke: white;
          stroke-dasharray: <?= $dashoffset ?>;
          stroke-dashoffset: <?= $dashoffset ?>;
          animation-name: DrawStroke;
          animation-duration: 3.5s;
          animation-iteration-count: 1;
          animation-fill-mode: forwards;
        }

        #wn-preload #text path {
          animation-name: DrawStrokeWhite;
        }

        @keyframes DrawStroke {
          80% {
            stroke: white;
            stroke-dashoffset: 0;
            fill: var(--primary-color);
          }

          100% {
            stroke-dashoffset: 0;
            stroke: white;
            fill: white;
          }
        }

        @keyframes DrawStrokeWhite {
          80% {
            stroke: white;
            stroke-dashoffset: 0;
            fill: var(--primary-color);
          }

          100% {
            stroke-dashoffset: 0;
            stroke: white;
            fill: white;
          }
        }
      </style>
      <script>
        $ = jQuery.noConflict();
        $(document).ready(function($) {
          function showLogo() {
            $('#wn-preload').fadeOut();
            $('#logo').addClass('logo-minimize');
            $('#logo .wn-below-logo').delay(1500).fadeIn();
          }

          const afterload = (new Date()).getTime();
          const seconds = (afterload - beforeload) / 1000;
          if (seconds < 3.5) {
            setTimeout(() => {
              showLogo()
            }, (3.5 - seconds) * 1000);
          } else {
            showLogo();
          }
        });
      </script>
<?php
    }
  }
});
