<?php
    get_header();
?>
<div id="main">
    <?php if(is_front_page()) : ?>
        <div class="container-fluid post-slider">
            <?php
                // render slider
                rx_petroip_display_slider_gallery(get_field('slider'));
            ?>
        </div>
        <span class="go-down"><a href="#content-area"></a></span>
    <?php else : ?>
    <div class="container-fluid post-thumbnail">
        <?php
        // Get the URL of the post thumbnail
        $thumbnail_url = get_the_post_thumbnail_url();

        // Output the thumbnail URL as a background image for the div
        echo '<div class="post-thumbnail-image" style="background-image: url(' . $thumbnail_url . ');   background-position: '.get_field('featured_image_vertical_position').' '.get_field('featured_image_horizontal_position').';"></div>';
        ?>
    </div>
    <?php endif ?>
    <div class="container">
        <div class="row">
                <div id="content-area" class="content-area">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'template-parts/content', get_post_type() ); ?>
                        <?php endwhile; ?>
                        <?php the_posts_pagination(); ?>
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                    <?php endif; ?>
                </div><!-- .content-area -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- #main -->

<?php
    get_footer();
?>