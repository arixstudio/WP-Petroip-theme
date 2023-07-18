<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php if(!is_front_page()) : ?>
      <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    <?php endif ?>
    <?php if ( 'post' === get_post_type() ) : ?>
      <div class="entry-meta">
        <?php // rx_petroip_posted_on(); ?>
      </div>
    <?php endif; ?>
  </header>
  <div class="entry-content">
    <?php
      the_content( sprintf(
        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rx-petroip' ),
        get_the_title()
      ) );

      wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'rx-petroip' ),
        'after'  => '</div>',
      ) );
    ?>
  </div>
</article>