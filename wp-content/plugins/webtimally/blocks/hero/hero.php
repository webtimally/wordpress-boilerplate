<?php

defined('ABSPATH') || exit;

function hero_render_callback($attr, $content)
{
  // Easier access to all attributes
  $mediaURL = !empty($attr['mediaURL']) ? $attr['mediaURL'] : "";
  $title = !empty($attr['title']) ? $attr['title'] : "";
  $subtitle = !empty($attr['subtitle']) ? $attr['subtitle'] : "";
  $url = !empty($attr['url']) ? $attr['url'] : "";
  $button = !empty($attr['button']) ? $attr['button'] : "";

  // Do not output anything if any of the mandatory fields are empty
  if (empty($mediaURL) || empty($title) || empty($url) || empty($button)) {
    return;
  }

  ob_start(); // Turn on output buffering

?>

  <section class="relative m-0">
    <div class="tpl-image h-[375px] sm:h-[800px] brightness-50">
      <img src="http://placeimg.com/1920/800/nature" alt="" />
    </div>
    <div class="
      absolute
      top-0
      left-0
      w-full
      h-full
      flex
      items-center
      justify-center
      text-white text-center
    ">
      <div class="tpl-container sm:w-2/3 justify-center">
        <h1 class="text-white mb-8">
          We will implement any task for your project
        </h1>
        <div class="sm:px-44 mb-10 sm:mb-16">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt
        </div>
        <a href="#" class="tpl-button tpl-button--border">Read more<i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </section>

<?php
  /* END HTML OUTPUT */

  $output = ob_get_contents(); // collect output
  ob_end_clean(); // Turn off ouput buffer

  return $output; // Print output
};
