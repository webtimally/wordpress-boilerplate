<?php

/**
 * Theme setup.
 */
function tailpress_setup()
{
  add_theme_support('title-tag');

  register_nav_menus(
    array(
      'primary' => __('Primary Menu', 'tailpress'),
    )
  );

  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );

  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');

  add_theme_support('align-wide');
  add_theme_support('wp-block-styles');

  add_theme_support('editor-styles');
  add_editor_style('css/app.css');
  add_editor_style('css/editor-style.css');
}

add_action('after_setup_theme', 'tailpress_setup');

/**
 * Enqueue theme assets.
 */
function tailpress_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_style('tailpress', tailpress_asset('css/app.css'), array(), $theme->get('Version'));
  wp_enqueue_script('tailpress', tailpress_asset('js/app.js'), array(), $theme->get('Version'));
}
add_action('wp_enqueue_scripts', 'tailpress_enqueue_scripts');

/**
 * Enqueue admin assets.
 */
function admin_enqueue_scripts($hook)
{
  $theme = wp_get_theme();

  if ($hook == "post.php") {
    wp_enqueue_style('tailpress', tailpress_asset('css/editor-style.css'), array(), $theme->get('Version'));
  }
}
add_action('admin_enqueue_scripts', 'admin_enqueue_scripts');

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function tailpress_asset($path)
{
  if (wp_get_environment_type() === 'production') {
    return get_stylesheet_directory_uri() . '/' . $path;
  }

  return add_query_arg('time', time(),  get_stylesheet_directory_uri() . '/' . $path);
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class($classes, $item, $args, $depth)
{
  if (isset($args->li_class)) {
    $classes[] = $args->li_class;
  }

  if (isset($args->{"li_class_$depth"})) {
    $classes[] = $args->{"li_class_$depth"};
  }

  return $classes;
}

add_filter('nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4);

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class($classes, $args, $depth)
{
  if (isset($args->submenu_class)) {
    $classes[] = $args->submenu_class;
  }

  if (isset($args->{"submenu_class_$depth"})) {
    $classes[] = $args->{"submenu_class_$depth"};
  }

  return $classes;
}

add_filter('nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3);

// Allow uploading SVG files
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Set up pre-loading of fonts
add_action("wp_head", function () {
  $fonts_dir = get_template_directory_uri() . '/fonts/';
  echo '<link rel="preload" href="' . $fonts_dir . 'poppins/poppins-regular.ttf" as="font" type="font/ttf" crossorgin>';
  echo '<link rel="preload" href="' . $fonts_dir . 'roboto/roboto-regular.ttf" as="font" type="font/ttf" crossorgin>';
});

// Remove the default Wordpress Gutenberg styles and scripts
function remove_wp_block_library_css()
{
  wp_deregister_script("wp-embed");

  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');

  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-styles');
  wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

// Edit the theme customizer section
function register_customize_sections($wp_customize)
{
  // 404 PAGE CUSTOMISATION
  $wp_customize->add_section("404_panel", array(
    "title" => "404 Page Customisation",
    "priority" => 200
  ));
  $wp_customize->add_setting("404_content_headline", array());
  $wp_customize->add_control("404_content_headline", array(
    "label" => "Headline",
    "section" => "404_panel",
  ));
  $wp_customize->add_setting("404_content_description", array());
  $wp_customize->add_control("404_content_description", array(
    "label" => "Description",
    "section" => "404_panel",
  ));
  $wp_customize->add_setting("404_content_button", array());
  $wp_customize->add_control("404_content_button", array(
    "label" => "Button text",
    "section" => "404_panel",
  ));


  // HEADER CUSTOMISATION
  $wp_customize->add_panel("header_panel", array(
    "title" => "Header Customisation",
    "priority" => 201
  ));
  $wp_customize->add_section("header_infobar_panel", array(
    "title" => "Information Bar",
    "priority" => 10,
    "panel" => "header_panel"
  ));
  $wp_customize->add_section("header_main_cta", array(
    "title" => "Main Call To Action",
    "priority" => 10,
    "panel" => "header_panel"
  ));
  // Settings for information bar
  $wp_customize->add_setting("header_infobar_address", array(
    "default" => ""
  ));
  $wp_customize->add_control("header_infobar_address", array(
    "label" => "Address",
    "section" => "header_infobar_panel",
  ));
  $wp_customize->add_setting("header_infobar_address_url", array(
    "default" => ""
  ));
  $wp_customize->add_control("header_infobar_address_url", array(
    "label" => "Address",
    "description" => "Copy/paste the URL from Google Maps",
    "section" => "header_infobar_panel",
    "type" => "url",
  ));
  $wp_customize->add_setting("header_infobar_phone", array(
    "default" => ""
  ));
  $wp_customize->add_control("header_infobar_phone", array(
    "label" => "Phone number",
    "section" => "header_infobar_panel",
  ));
  $wp_customize->add_setting("header_infobar_email", array(
    "default" => ""
  ));
  $wp_customize->add_control("header_infobar_email", array(
    "label" => "Email",
    "section" => "header_infobar_panel",
    "type" => "email"
  ));
  // Settings for information bar
  $wp_customize->add_setting("header_main_cta_text", array(
    "default" => ""
  ));
  $wp_customize->add_control("header_main_cta_text", array(
    "label" => "Label",
    "section" => "header_main_cta",
  ));
  $wp_customize->add_setting("header_main_cta_url", array(
    "default" => ""
  ));
  $wp_customize->add_control("header_main_cta_url", array(
    "label" => "URL",
    "section" => "header_main_cta",
    "type" => "dropdown-pages"
  ));


  // FOOTER CUSTOMISATION
  // Create the panels
  $wp_customize->add_panel("footer_panel", array(
    "title" => "Footer Customisation",
    "priority" => 301
  ));
  $wp_customize->add_section("footer_company_panel", array(
    "title" => "Company Description",
    "priority" => 10,
    "panel" => "footer_panel"
  ));
  $wp_customize->add_section("footer_information_panel", array(
    "title" => "Information",
    "priority" => 20,
    "panel" => "footer_panel"
  ));
  $wp_customize->add_section("footer_contact_panel", array(
    "title" => "Contact Us",
    "priority" => 30,
    "panel" => "footer_panel"
  ));

  // Settings for company details section
  $wp_customize->add_setting("footer_content_headline", array());
  $wp_customize->add_control("footer_content_headline", array(
    "label" => "Headline",
    "section" => "footer_company_panel",
  ));
  $wp_customize->add_setting("footer_content_description", array());
  $wp_customize->add_control("footer_content_description", array(
    "label" => "Description",
    "section" => "footer_company_panel",
    "type" => "textarea"
  ));

  // Settings for information section
  $wp_customize->add_setting("footer_content_information", array());
  $wp_customize->add_control("footer_content_information", array(
    "section" => "footer_information_panel",
  ));

  // Settings for contact us section
  $wp_customize->add_setting("footer_content_contact_us", array());
  $wp_customize->add_control("footer_content_contact_us", array(
    "label" => "Headline",
    "section" => "footer_contact_panel",
  ));
  $wp_customize->add_setting("footer_content_contact_us_phone", array());
  $wp_customize->add_control("footer_content_contact_us_phone", array(
    "label" => "Phone number",
    "section" => "footer_contact_panel",
  ));
  $wp_customize->add_setting("footer_content_contact_us_email", array());
  $wp_customize->add_control("footer_content_contact_us_email", array(
    "label" => "Email",
    "section" => "footer_contact_panel",
    "type" => "email"
  ));
}
add_action("customize_register", "register_customize_sections");

// Attach a new blocks category
function webtimally_block_category($categories)
{
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'webtimally',
        'title' => __('Webtimally', 'webtimally'),
      ),
    )
  );
}
add_filter('block_categories_all', 'webtimally_block_category');
