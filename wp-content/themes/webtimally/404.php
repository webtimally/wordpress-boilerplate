<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body class="antialiased bg-blue-900">
  <main class="grid place-content-center place-item-center w-screen h-screen">
    <div class="container">
      <div class="text-center">
        <h1 class="text-white text-[150px] leading-none">404</h1>
        <h2 class="text-white text-4xl mb-4"><?php echo get_theme_mod("404_content_headline"); ?></h2>
        <p class="text-white font-body text-lg mb-16"><?php echo get_theme_mod("404_content_description"); ?></p>
        <a href="<?php echo get_bloginfo('url'); ?>" class="tpl-button tpl-button--white"><?php echo get_theme_mod("404_content_button"); ?></a>
      </div>
    </div>
  </main>
</body>

</html>