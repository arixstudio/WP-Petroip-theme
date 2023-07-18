<?php

load_theme_textdomain( 'rx-petroip', get_template_directory() . '/languages' );

/**
 * Load theme resources and styles.
 */
function rx_petroip_enqueue_resources() {

    if(is_rtl())
    {
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.rtl.min.css', array(), '5.0.2' );
        wp_enqueue_style( 'rx-petroip-rtl-style', get_stylesheet_uri() .'rtl.css', array(), '1.0' );
    } else {
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2' );
    }

    wp_enqueue_style( 'rx-petroip-style', get_stylesheet_uri(), array(), '1.0' );
    
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '5.0.2', true );
    wp_enqueue_script( 'rx-petroip', get_template_directory_uri() . '/assets/js/rx-petroip.js', array( 'jquery' ) );
    wp_enqueue_script( 'rx-slider', get_template_directory_uri() . '/assets/js/rx-slider.js', array( 'jquery' ) );
    wp_enqueue_style('dashicons');

}
add_action( 'wp_enqueue_scripts', 'rx_petroip_enqueue_resources' );

function rx_petroip_enqueue_slider_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script( 'slider-scripts', get_template_directory_uri() . '/assets/js/admin/rx-slider-metabox.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'rx_petroip_enqueue_slider_scripts' );

// Theme setup
function rx_petroip_setup() {

    // Support post thumbnail
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'rx_petroip_setup');


// Register Custom Navigation Walker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Register navigation menus.
 */
function rx_petroip_register_nav_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'rx-petroip' ),
    ) );
}
add_action( 'after_setup_theme', 'rx_petroip_register_nav_menus' );

// Custom logo
function theme_customize_register( $wp_customize ) {
    
    // Add settings for English and Farsi logos
    $wp_customize->add_setting( 'logo_en', array(
        'type'              => 'option',
        'capability'        => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_setting( 'logo_fa', array(
        'type'              => 'option',
        'capability'        => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    // Add controls for English and Farsi logos
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_en', array(
        'label'    => __( 'Logo (English)','rx-petroip' ),
        'section'  => 'title_tagline',
        'settings' => 'logo_en',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_fa', array(
        'label'    => __( 'Logo (Farsi)','rx-petroip' ),
        'section'  => 'title_tagline',
        'settings' => 'logo_fa',
    ) ) );
    
}
add_action( 'customize_register', 'theme_customize_register' );



// Widget areas
function rx_petroip_widgets_init() {
    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'rx_petroip_widgets_init' );

/*
 * Create a custom post type called "Product"
 */
function rx_petroip_create_product_post_type() {
    $labels = array(
        'name' => __( 'Products','rx-petroip' ),
        'singular_name' => __( 'Product','rx-petroip' ),
        'menu_name' => __( 'Products','rx-petroip' ),
        'add_new' => __( 'Add New','rx-petroip'),
        'add_new_item' => __( 'Add New Product','rx-petroip'),
        'edit_item' => __( 'Edit Product','rx-petroip'),
        'new_item' => __( 'New Product','rx-petroip'),
        'view_item' => __( 'View Product','rx-petroip'),
        'search_items' => __( 'Search Products','rx-petroip'),
        'not_found' => __( 'No products found','rx-petroip'),
        'not_found_in_trash' => __( 'No products found in trash','rx-petroip'),
        'parent_item_colon' => __( 'Parent Product:','rx-petroip'),
        'all_items' => __( 'All Products','rx-petroip'),
        'archives' => __( 'Product Archives','rx-petroip'),
        'attributes' => __( 'Product Attributes','rx-petroip'),
        'insert_into_item' => __( 'Insert into product','rx-petroip'),
        'uploaded_to_this_item' => __( 'Uploaded to this product','rx-petroip'),
        'featured_image' => __( 'Featured Image','rx-petroip'),
        'set_featured_image' => __( 'Set featured image','rx-petroip'),
        'remove_featured_image' => __( 'Remove featured image','rx-petroip'),
        'use_featured_image' => __( 'Use as featured image','rx-petroip'),
    );
    $args = array(
        'labels' => $labels,
        'description' => __( 'Products post type','rx-petroip' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'products' ),
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', 'author', 'page-attributes', 'post-formats' ),
        'menu_icon' => 'dashicons-archive',
        'capability_type' => 'post',
        'taxonomies' => array( 'category', 'post_tag' ),
        'show_in_rest' => true,
        'rest_base' => 'products',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'show_in_graphql' => true,
        'graphql_single_name' => 'product',
        'graphql_plural_name' => 'products',
    );
    register_post_type( 'product', $args );
}
add_action( 'init', 'rx_petroip_create_product_post_type' );


/*
 * Create a custom post type called "Testimonial"
 */
function rx_petroip_create_testimonial_post_type() {
    $labels = array(
        'name' => __( 'Testimonials','rx-petroip'),
        'singular_name' => __( 'Testimonial','rx-petroip'),
        'menu_name' => __( 'Testimonials','rx-petroip'),
        'add_new' => __( 'Add New','rx-petroip'),
        'add_new_item' => __( 'Add New Testimonial','rx-petroip'),
        'edit_item' => __( 'Edit Testimonial','rx-petroip'),
        'new_item' => __( 'New Testimonial','rx-petroip'),
        'view_item' => __( 'View Testimonial','rx-petroip'),
        'search_items' => __( 'Search Testimonials','rx-petroip'),
        'not_found' => __( 'No testimonials found','rx-petroip'),
        'not_found_in_trash' => __( 'No testimonials found in trash','rx-petroip'),
        'parent_item_colon' => __( 'Parent Testimonial:','rx-petroip'),
        'all_items' => __( 'All Testimonials','rx-petroip'),
        'archives' => __( 'Testimonial Archives','rx-petroip'),
        'attributes' => __( 'Testimonial Attributes','rx-petroip'),
        'insert_into_item' => __( 'Insert into testimonial','rx-petroip'),
        'uploaded_to_this_item' => __( 'Uploaded to this testimonial','rx-petroip'),
        'featured_image' => __( 'Featured Image','rx-petroip'),
        'set_featured_image' => __( 'Set featured image','rx-petroip'),
        'remove_featured_image' => __( 'Remove featured image','rx-petroip'),
        'use_featured_image' => __( 'Use as featured image','rx-petroip'),
    );
    $args = array(
        'labels' => $labels,
        'description' => __( 'Testimonials post type','rx-petroip' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'has_archive' => false,
        'rewrite' => array( 'slug' => 'testimonials' ),
        'supports' => array( 'title', 'editor'),
        'menu_icon' => 'dashicons-awards',
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rest_base' => 'testimonials',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'show_in_graphql' => true,
        'graphql_single_name' => 'testimonial',
        'graphql_plural_name' => 'testimonials',
    );
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'rx_petroip_create_testimonial_post_type' );

// Register footer widgets
function rx_petroip_register_footer_widgets() {
    register_sidebar( array(
        'name'          => __( 'Footer 1', 'rx-petroip' ),
        'id'            => 'footer-column-1',
        'description'   => __( 'Add widgets here to appear in the first column of the footer.', 'rx-petroip' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2', 'rx-petroip' ),
        'id'            => 'footer-column-2',
        'description'   => __( 'Add widgets here to appear in the second column of the footer.', 'rx-petroip' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Bottom bar 1', 'rx-petroip' ),
        'id'            => 'bottom-bar-column-1',
        'description'   => __( 'Add widgets here to appear in the first column of the bottom bar.', 'rx-petroip' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Bottom bar 2', 'rx-petroip' ),
        'id'            => 'bottom-bar-column-2',
        'description'   => __( 'Add widgets here to appear in the second column of the bottom bar.', 'rx-petroip' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'rx_petroip_register_footer_widgets' );

// Register Contact detail block
function rx_petroip_register_block() {
    
    wp_register_script(
        'rx-petroip-block-contact',
        get_template_directory_uri() . '/assets/js/admin/rx-petroip-block-contact.js',
        array( 'wp-blocks', 'wp-element', 'wp-components' ),
        filemtime( get_template_directory() . '/assets/js/admin/rx-petroip-block-contact.js' ),
        true
    );

    register_block_type( 'rx-petroip/contact-detail', array(
      'editor_script' => 'rx-petroip-block-contact',
      'render_callback' => 'rx_petroip_render_contact_detail_block',
      'attributes' => array(
        'email' => array(
          'type' => 'string',
          'source' => 'text',
          'selector' => '.email'
        ),
        'address' => array(
          'type' => 'string',
          'source' => 'text',
          'selector' => '.address'
        ),
        'phone' => array(
          'type' => 'string',
          'source' => 'text',
          'selector' => '.phone'
        )
      )
    ) );
        
    wp_register_script(
        'rx-petroip-block-social-media',
        get_template_directory_uri() . '/assets/js/admin/rx-petroip-block-social-media.js',
        array( 'wp-blocks', 'wp-element', 'wp-components' ),
        filemtime( get_template_directory() . '/assets/js/admin/rx-petroip-block-social-media.js' ),
        true
    );

    register_block_type( 'rx-petroip/social-media', array(
      'editor_script' => 'rx-petroip-block-social-media',
      'render_callback' => 'rx_petroip_render_social_media_block',
      'attributes' => array(
        'email' => array(
          'type' => 'string',
          'source' => 'text',
          'selector' => '.email'
        ),
        'phone' => array(
          'type' => 'string',
          'source' => 'text',
          'selector' => '.phone'
        ),
        'address' => array(
          'type' => 'string',
          'source' => 'text',
          'selector' => '.address'
        ),
      )
    ) );
    
    wp_register_script(
        'rx-petroip-block-products',
        get_template_directory_uri() . '/assets/js/admin/rx-petroip-block-products.js',
        array( 'wp-blocks', 'wp-element' ),
        filemtime( get_template_directory() . '/assets/js/admin/rx-petroip-block-products.js' ),
        true
    );

    register_block_type( 'rx-petroip/products', array(
      'editor_script' => 'rx-petroip-block-products',
      'render_callback' => 'rx_petroip_render_products_block',
    ) );

    wp_register_script(
        'rx-petroip-block-testimonials',
        get_template_directory_uri() . '/assets/js/admin/rx-petroip-block-testimonials.js',
        array( 'wp-blocks', 'wp-element' ),
        filemtime( get_template_directory() . '/assets/js/admin/rx-petroip-block-testimonials.js' ),
        true
    );

    register_block_type( 'rx-petroip/testimonials', array(
      'editor_script' => 'rx-petroip-block-testimonials',
      'render_callback' => 'rx_petroip_render_testimonials_block',
    ) );
    
}
add_action( 'init', 'rx_petroip_register_block' );

function rx_petroip_render_products_block( $attributes ) {

    $layout = $attributes['layout'];
    $limit = $attributes['numberOfItems'] == '0' ? '-1' : $attributes['numberOfItems'];
    $cols = $attributes['numberOfColumns'] ? $attributes['numberOfColumns'] : 4;

    // var_dump($attributes);
    $products = rx_petroip_get_products($limit);

    $output = '';
    if ($products) {
      $output .= '<div class="products-grid '.$layout.' row row-cols-1 row-cols-md-'.$cols.' g-5">';
      foreach ($products as $post) {

        setup_postdata($post);

        $excerpt = apply_filters('the_content',  ( get_post($post)->post_excerpt) );
  
        $output .= '<div class="col">';
        $output .= '<div class="card product-card">';
        $output .= '<img src="' . get_field('icon',$post) . '" class="product-icon card-img-top" alt="' . get_the_title($post) . '">';
        $output .= '<div class="card-body">';
        $output .= '<h5 class="card-title"><a href="' . get_the_permalink($post) . '">' . get_the_title($post) . '</a></h5>';
        $output .= '<p class="card-text">' . $excerpt . '</p>';
        $output .= '<a href="' . get_the_permalink($post) . '" class="btn"><img src="'.get_template_directory_uri().'/assets/img/arrow.svg"></a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
      }
      $output .= '</div>';
  
      wp_reset_postdata();
    }
  
    return $output;
}

function rx_petroip_render_testimonials_block( $attributes ) {

    $limit = $attributes['numberOfItems'] == '0' ? '-1' : $attributes['numberOfItems'];
    
    $testimonials = rx_petroip_get_testimonials($limit);

    $output = '';
    if ($testimonials) {

        $output .= '<div class="wide-section">';
            $output .= '<div id="testimonialSlider" class="container-fluid carousel slide" data-bs-ride="carousel" style="background-image: url('.get_template_directory_uri().'/assets/img/pipline-vector.svg)">';
            $output .= '<div class="carousel-inner">';
                $output .= '<h1 class="text-center mb-5">'.__('What our clients say','rx-petroip').'</h1>';
                $counter = 0;
                foreach ($testimonials as $post) {

                    setup_postdata($post);

                    $active = ($counter == 0) ? 'active' : '';

                    $output .= '<div class="carousel-item ' . $active . '">';
                        $output .= '<div class="testimonial">';
                            $output .= '<div class="testimonial-text">' . get_the_content($post) . '</div>';
                            $output .= '<div class="testimonial-author">' . get_the_title($post) . '</div>';
                        $output .= '</div>';
                    $output .= '</div>';

                    $counter++;
                }
            $output .= '</div>';
    
    }

    wp_reset_postdata();

    $output .= '<button class="carousel-control-prev" type="button" data-bs-target="#testimonialSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>';

    $output .= '</div>';
    return $output;
}


/*
 * Create a custom post type called "Slider"
 */
function rx_petroip_register_slider_post_type() {
    $labels = array(
        'name' => __('Sliders','rx-petroip'),
        'singular_name' => __('Slider','rx-petroip'),
        'add_new' => __('Add New','rx-petroip'),
        'add_new_item' => __('Add New Slider','rx-petroip'),
        'edit_item' => __('Edit Slider','rx-petroip'),
        'new_item' => __('New Slider','rx-petroip'),
        'view_item' => __('View Slider','rx-petroip'),
        'search_items' => __('Search Sliders','rx-petroip'),
        'not_found' => __('No Sliders found','rx-petroip'),
        'not_found_in_trash' => __('No Sliders found in Trash','rx-petroip'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array('title', 'custom-fields'),
    );
    register_post_type('slider', $args);
}
add_action('init', 'rx_petroip_register_slider_post_type');

function add_slider_images_field() {
    add_meta_box(
        'slider_images',
        'Slider Images',
        'rx_petroip_render_slider_images_field',
        'slider',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_slider_images_field' );

function rx_petroip_render_slider_images_field( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'slider_images_nonce' );
    $gallery = get_post_meta( $post->ID, '_slider_gallery', true );
    echo '<style>
    .slider_image_preview {
        height: 200px;
        width: 100%;
        background-size: cover;
        background-position: center;
        border: 1px solid #fff;
        transition: all 0.5s;
        border-radius: 6px;
    }
    .slider_image_preview:hover {
        border: 1px dashed #fff;
    }
    .slider_image {
        height: 220px;
    }
    .slider_image:hover {
        cursor: grab;
    }
    .slider_image label {
        top: -85px;
        position: relative;
        display: block;
        margin: 8px;
    }
    .slider_image_remove {
    background-color: #d63638;
    border-radius: 3px;
    color: #fff;
    text-decoration: none;
    padding: 6px;
    margin: 8px;
    position: relative;
    top: 33px;
    }
    .slider_image_remove:hover {
    background-color: #ec191c;
    color: #fff;
    }</style>';

    echo '<div id="slider_gallery">';
    if ( !empty( $gallery ) ) {
        foreach ( $gallery as $id => $image ) {
            echo '<div class="slider_image">';
            echo '<a class="slider_image_remove" href="#">Remove Image</a>';
            echo '<div class="slider_image_preview" style="background-image: url(' . esc_url( $image['url'] ) . ');"></div>';
            echo '<input type="hidden" class="slider_image_url" name="slider_gallery[' . esc_attr( $id ) . '][url]" value="' . esc_url( $image['url'] ) . '" />';
            echo '<label><input type="text" class="slider_image_subtitle" name="slider_gallery[' . esc_attr( $id ) . '][subtitle]" value="' . esc_attr( $image['subtitle'] ) . '" placeholder="Subtitle"/></label>';
            echo '<label><input type="text" class="slider_image_title" name="slider_gallery[' .esc_attr( $id ) . '][title]" value="' . esc_attr( $image['title'] ) . '" placeholder="Title"/></label>';
            echo '</div>';
        }
    }
    echo '</div>';
    echo '<br>';
    echo '<a class="slider_image_add button" href="#">Add Image</a>';
}

function save_slider_images_field( $post_id ) {
    if( !isset( $_POST['slider_images_nonce'] ) || !wp_verify_nonce( $_POST['slider_images_nonce'], basename( __FILE__ ) ) )
        return;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if( !current_user_can( 'edit_post', $post_id ) )
        return;
    if( isset( $_POST['slider_gallery'] ) )
        update_post_meta( $post_id, '_slider_gallery', $_POST['slider_gallery'] );
    else
        delete_post_meta( $post_id, '_slider_gallery' );
}
add_action( 'save_post', 'save_slider_images_field' );

function rx_petroip_display_slider_gallery($slider_id) {
    $images = get_post_meta($slider_id, '_slider_gallery', true);
    ?>
    <?php if (is_array($images) && !empty($images)) : ?>        
        <div class="slider">
            <div class="slider-container">
                <?php foreach($images as $index => $image) : ?>
                <div class="slider-item <?php echo $index == 0 ? 'active' : '' ?>" style="background-image: url('<?php echo $image['url'] ?>'); background-position: top;">
                    <div class="container">
                        <div class="slider-caption">
                            <p class="slider-subtitle"><?php echo $image['subtitle'] ? $image['subtitle'] : '-' ?></p>
                            <h2 class="slider-title"><?php echo $image['title'] ?></h2>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="container">
                <div class="slider-nav">
                    <?php foreach($images as $index => $image) : ?>
                    <div class="slider-bullet <?php echo $index == 0 ? 'active' : '' ?>"></div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php
}

function rx_petroip_get_testimonials($number_of_posts = -1) {
    $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => $number_of_posts,
        'orderby' => 'menu_order',
      );
    $query = new WP_Query($args);
    return $query->posts;
}

function rx_petroip_get_products($number_of_posts = -1) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $number_of_posts,
        'orderby' => 'menu_order',
      );
    $query = new WP_Query($args);
    return $query->posts;
}



function rx_product_icon_shortcode() {

    // Get icon from ACF field
    $icon = get_field('icon');
    
    // Return icon image HTML
    return '<img class="product-icon d-none d-md-block" src="' . $icon . '" alt="Product icon">';
}
add_shortcode( 'rx_product_icon', 'rx_product_icon_shortcode' );

function rx_customize_register( $wp_customize ) {
    // Add section for custom colors
    $wp_customize->add_section( 'rx_custom_colors', array(
        'title' => __( 'Theme Colors','rx-petroip'),
        'priority' => 30,
    ) );

    // Add primary color setting
    $wp_customize->add_setting( 'rx_primary_color', array(
        'default' => '#373737',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rx_primary_color', array(
        'label' => __( 'Primary Color', 'rx-petroip' ),
        'section' => 'rx_custom_colors',
        'settings' => 'rx_primary_color',
    ) ) );

    // Add secondary color setting
    $wp_customize->add_setting( 'rx_secondary_color', array(
        'default' => '#424242',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rx_secondary_color', array(
        'label' => __( 'Secondary Color', 'rx-petroip' ),
        'section' => 'rx_custom_colors',
        'settings' => 'rx_secondary_color',
    ) ) );

    // Add highlight color setting
    $wp_customize->add_setting( 'rx_highlight_color', array(
        'default' => '#FF2434',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'rx_highlight_color', array(
        'label' => __( 'Highlight Color', 'rx-petroip' ),
        'section' => 'rx_custom_colors',
        'settings' => 'rx_highlight_color',
    ) ) );
}
add_action( 'customize_register', 'rx_customize_register' );


function rx_petroip_update_svg_colors() {

    $file_path = get_template_directory().'/assets/img/pipline-vector.svg';

    $primary_color = get_theme_mod( 'rx_primary_color', '#373737' );
    $secondary_color = get_theme_mod( 'rx_secondary_color', '#424242' );

    // Read the contents of the SVG file
    $svg_content = file_get_contents($file_path);

    // Find the :root block in the SVG file
    preg_match('/:root[^}]*\{[^}]*\}/', $svg_content, $matches);

    // If the :root block is found, update the color variables and save the file
    if (!empty($matches)) {
        // Extract the current values of the color variables
        preg_match_all('/--(primary|secondary)-color:\s*(#[a-f0-9]{3,6})/', $matches[0], $color_matches);
        $existing_primary_color = $color_matches[2][0];
        $existing_secondary_color = $color_matches[2][1];

        // Replace the values of the color variables with the new values
        $updated_content = str_replace(
            [$existing_primary_color, $existing_secondary_color],
            [$primary_color, $secondary_color],
            $svg_content
        );

        // Save the updated SVG file
        file_put_contents($file_path, $updated_content);
    }
}

add_action( 'customize_save_after', 'rx_petroip_update_svg_colors' );
