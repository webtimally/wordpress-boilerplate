<?php

/**
 * Plugin Name:       Webtimally
 * Description:       All the building blocks required to build the website webtimally.dk
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Webtimally
 * Text Domain:       webtimally
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function create_block_multiple_blocks_plugin_block_init()
{
  // Loop through all of the files inside the blocks folder
  foreach (new DirectoryIterator(__DIR__ . '/blocks') as $item) {

    // If the file is a folder and has a block.json file
    if ($item->isDir() && !$item->isDot()) if (file_exists($item->getPathname() . '/block.json')) {

      // Check if the plugin is a dynamic block when a php file exists in the root
      if (file_exists($item->getPathname() . '/' . $item->getBasename() . '.php')) {

        // Include the PHP file to execute the render_callback
        include($item->getPathname() . '/' . $item->getBasename() . '.php');
        register_block_type($item->getPathname(), array(
          'render_callback' => str_replace('-', '_', $item->getBasename()) . '_render_callback'
        ));
      } else {
        register_block_type($item->getPathname());
      }
    }
  }
}
add_action('init', 'create_block_multiple_blocks_plugin_block_init');

// A function to filter which blocks are allowed to be used
function my_plugin_deny_list_blocks()
{
  if (get_post_type() == "post") {
    wp_enqueue_script(
      'my-plugin-deny-list-blocks',
      plugins_url('my-plugin-post.js', __FILE__),
      array('wp-blocks', 'wp-dom-ready', 'wp-edit-post')
    );
  } else {
    wp_enqueue_script(
      'my-plugin-deny-list-blocks',
      plugins_url('my-plugin-page.js', __FILE__),
      array('wp-blocks', 'wp-dom-ready', 'wp-edit-post')
    );
  }
}
add_action('enqueue_block_editor_assets', 'my_plugin_deny_list_blocks');
