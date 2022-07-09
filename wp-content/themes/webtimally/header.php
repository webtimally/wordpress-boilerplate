<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(''); ?>>

  <?php do_action('tailpress_site_before'); ?>

  <div class="">

    <?php do_action('tailpress_header'); ?>

    <header>

      <?php get_template_part('theme/template-parts/toolbar'); ?>

      <?php get_template_part('theme/template-parts/menubar'); ?>

    </header>

    <?php do_action('tailpress_content_start'); ?>

    <main>