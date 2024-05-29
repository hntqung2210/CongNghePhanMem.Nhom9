<?php

add_filter(
  'wp_check_filetype_and_ext',
  function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {
    if (!$wp_check_filetype_and_ext['type']) {

      $check_filetype  = wp_check_filetype($filename, $mimes);
      $ext             = $check_filetype['ext'];
      $type            = $check_filetype['type'];
      $proper_filename = $filename;

      if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
        $ext  = false;
        $type = false;
      }

      $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
    }

    return $wp_check_filetype_and_ext;
  },
  10,
  5
);

add_action('admin_init', function () {
  register_setting(WN_PLUGIN_SLUG . '_settings', WN_PLUGIN_SLUG . '_hide_install_plugin_warning', ['type' => 'boolean']);
  register_setting(WN_PLUGIN_SLUG . '_settings', WN_PLUGIN_SLUG . '_show_loading', ['type' => 'boolean']);
  register_setting(WN_PLUGIN_SLUG . '_settings', WN_PLUGIN_SLUG . '_background', ['type' => 'string']);
  register_setting(WN_PLUGIN_SLUG . '_settings', WN_PLUGIN_SLUG . '_dashoffset', ['type' => 'integer']);
  register_setting(WN_PLUGIN_SLUG . '_settings', WN_PLUGIN_SLUG . '_logo_svg', ['type' => 'integer']);

  add_settings_section(WN_PLUGIN_SLUG . '_section', '', '', WN_PLUGIN_SLUG);
  add_settings_field(
    WN_PLUGIN_SLUG . '_hide_install_plugin_warning',
    __('Ẩn cảnh báo cài đặt plugin', 'wn'),
    function () {
      $hide_warning_name = WN_PLUGIN_SLUG . '_hide_install_plugin_warning';
      $value = get_option($hide_warning_name);
      echo "<input name='{$hide_warning_name}' type='checkbox' " . ($value == 'on' ? 'checked' : '') . " />";
    },
    WN_PLUGIN_SLUG,
    WN_PLUGIN_SLUG . '_section'
  );
  add_settings_field(
    WN_PLUGIN_SLUG . '_show_loading',
    __('Hiển thị loading', 'wn'),
    function () {
      $show_loading_name = WN_PLUGIN_SLUG . '_show_loading';
      $value = get_option($show_loading_name);
      echo "<input name='{$show_loading_name}' type='checkbox' " . ($value == 'on' ? 'checked' : '') . " />";
    },
    WN_PLUGIN_SLUG,
    WN_PLUGIN_SLUG . '_section'
  );
  add_settings_field(
    WN_PLUGIN_SLUG . '_logo_svg',
    __('Logo SVG', 'wn'),
    function () {
      $logo = WN_PLUGIN_SLUG . '_logo_svg';
      $value = get_option($logo);
      $url = $value ? wp_get_attachment_image_url($value) : '';
?>
    <div>
      <input id="wn-upload-logo" type="button" class="button button-secondary" name="<?= $logo ?>" value="<?= __('Tải lên', 'wn') ?>" />
      <input type="hidden" class="wn-logo-svg" name="<?php echo WN_PLUGIN_SLUG . '_logo_svg' ?>" value="<?= $value ?>" />
    </div>
    <img src="<?= $url ?>" class="wn-logo" style="width:80px;object-fit:cover;aspect-ratio:1;<?= ($value ? '' : 'display: none;') ?>" />
    <script type="text/javascript">
      $ = jQuery.noConflict();
      $(document).ready(function($) {
        $('#wn-upload-logo').on('click', function() {
          const media = wp.media({
            title: 'Tải lên',
            multiple: false
          }).open();
          media.on('select', function() {
            const file = media.state().get('selection').first();
            $('.wn-logo-svg').val(file.id);
            $('.wn-logo').show().attr('src', file.attributes.url);
          });
        });
      });
    </script>
  <?php
    },
    WN_PLUGIN_SLUG,
    WN_PLUGIN_SLUG . '_section'
  );
  add_settings_field(
    WN_PLUGIN_SLUG . '_dashoffset',
    __('DashOffset', 'wn'),
    function () {
      $dashoffset_name = WN_PLUGIN_SLUG . '_dashoffset';
      $value = get_option($dashoffset_name);
      echo "<input name='{$dashoffset_name}' type='text' value='" . $value . "' />";
    },
    WN_PLUGIN_SLUG,
    WN_PLUGIN_SLUG . '_section'
  );
  add_settings_field(
    WN_PLUGIN_SLUG . '_background',
    __('Màu nền', 'wn'),
    function () {
      $bg_name = WN_PLUGIN_SLUG . '_background';
      $value = get_option($bg_name);
  ?>
    <input name="<?= $bg_name ?>" class="wn-color-field" type="text" value="<?= $value ?>" />
    <script type="text/javascript">
      $ = jQuery.noConflict();
      $(document).ready(function($) {
        $('.wn-color-field').wpColorPicker();
      });
    </script>
  <?php
    },
    WN_PLUGIN_SLUG,
    WN_PLUGIN_SLUG . '_section'
  );
});

add_action('admin_menu', function () {
  add_options_page(
    __('Cài đặt tiện ích WebNow', 'wn'),
    __('Cài đặt WebNow', 'wn'),
    'manage_options',
    WN_PLUGIN_SLUG,
    'wn_render_option_page'
  );
});

function wn_render_option_page() {
  ?>
  <div class="wrap">
    <h1><?php echo get_admin_page_title() ?></h1>
    <form action="options.php" method="post">
      <?php
      settings_fields(WN_PLUGIN_SLUG . '_settings');
      do_settings_sections(WN_PLUGIN_SLUG);
      submit_button();
      ?>
    </form>
  </div>
<?php
}
