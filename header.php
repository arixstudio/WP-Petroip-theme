<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title( '|', true, 'right' ); ?><?php echo get_bloginfo( 'name' ); ?><?php if ( get_bloginfo( 'description' ) ) : ?><?php echo ' - ' . get_bloginfo( 'description' ); ?><?php endif; ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Custom colors -->
<style>
:root {
  --primary-color: <?php echo get_theme_mod( 'rx_primary_color', '#373737' ); ?>;
  --secondary-color: <?php echo get_theme_mod( 'rx_secondary_color', '#424242' ); ?>;
  --highlight-color: <?php echo get_theme_mod( 'rx_highlight_color', '#FF2434' ); ?>;
}
</style>
<header class="site-header">
    <nav class="navbar navbar-expand-md">
        <div class="container px-4">
            <?php if ( has_custom_logo() ) : ?>
                <a href="<?php echo home_url() ?>" class="custom-logo-link" rel="home" aria-current="page">
                    <img class="custom-logo" src="<?php echo get_option('logo_'.pll_current_language(), true); ?>" >
                </a>
            <?php else : ?>
                <div class="navbar-brand-wrapper">
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    <div class="navbar-tagline">
                        <?php bloginfo( 'description' ); ?>
                    </div>
                </div>
            <?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'rx-petroip' ); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            wp_nav_menu( array(
                'theme_location'  => 'primary',
                'depth'           => 3,
                'container'       => 'div',
                'container_class' => 'collapse navbar-collapse pe-3',
                'container_id'    => 'navbarNav',
                'menu_class'      => 'navbar-nav ms-auto mb-3 mt-3 px-3',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            ) );
            ?>
        </div>
    </nav>
</header>