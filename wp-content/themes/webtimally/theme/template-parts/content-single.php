<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="entry-content">

    <section data-block-name="page-title" class="bg-blue-800 thinner">
      <div class="container">
        <div class="text-center lg:text-left sm:flex sm:justify-between place-items-center">
          <div class="lg:pr-10">
            <h1 class="text-white mb-0"><?php echo the_title(); ?></h1>
          </div>
          <?php if (function_exists('bcn_display')) : ?>
            <div class="text-white hidden sm:block">
              <?php if (function_exists('bcn_display')) bcn_display(); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php
    $post_author_id = get_post_field('post_author');
    $post_datetime = get_post_field('post_date_gmt');
    $post_content = empty(get_post_field('post_excerpt')) ? wp_trim_words(get_post_field('post_content'), 20, '...') : get_post_field('post_excerpt');
    $post_image = wp_get_attachment_image_src(get_post_thumbnail_id(""), 'large')[0];
    ?>

    <section data-block-name="post" class="md:bg-grey-100 pt-8">
      <div class="md:container">
        <div class="bg-white md:p-16 px-8 md:rounded-md md:z-10 md:w-3/4 md:mx-auto md:shadow-lg grid gap-8">
          <div class="flex place-content-center">
            <img class="lazy" src="<?php echo $post_image; ?>" alt="" />
          </div>
          <div>
            <div class="text-sm">
              <span class="opacity-90">
                <span><?php echo date_i18n("d F Y", $post_datetime); ?></span>
                <span> | </span>
                <?php echo (!empty($byLabel) ? '<span>' . $byLabel . '</span>' : ''); ?>
              </span>
              <span>
                <span class="text-grey-900"><?php echo get_the_author_meta('display_name', $post_author_id);?></span>
              </span>
            </div>
          </div>
          <div>
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </section>


  </div>

</article>