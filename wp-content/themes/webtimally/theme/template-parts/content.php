<?php if (is_search() || is_archive()) : ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

<?php else : ?>

	<?php
	/* translators: %s: Name of current post */
	the_content(
		sprintf(
			__('Continue reading %s', 'tailpress'),
			the_title('<span class="screen-reader-text">"', '"</span>', false)
		)
	);

	wp_link_pages(
		array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'tailpress') . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'tailpress') . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		)
	);
	?>

<?php endif; ?>