<?php 

/* 
    functions.php
    contains all functionality used in theme
*/


require_once('constant.php');

// adding menu
if(!function_exists('my_reg_menu')){

    function my_reg_menu(){

        register_nav_menus([
            'primary_menu' => __('Primary Menu', TEXT_DOMAIN)
        ]);

    }

    add_action( 'after_setup_theme', 'my_reg_menu');

}


// adding sidebar widget
if(!function_exists('my_reg_sidebars')){

    function my_reg_sidebars(){

        // blog sidebar
        register_sidebar( array(
            'name'          => __( 'Blog Sidebar', TEXT_DOMAIN ),
            'id'            => 'blog-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

    }

    add_action( 'widgets_init', 'my_reg_sidebars' );

}


// adding script and styles
if(!function_exists('my_add_static_files')){

    function my_add_static_files(){

        wp_enqueue_style( 'my_bootstrap.css', TEMP_DIR_URI . '/css/bootstrap.css', [], 5.1);
        wp_enqueue_style('my_slider.css', TEMP_DIR_URI . '/css/paperstack.css', [], 1.0);
        wp_enqueue_style('my_style.css', TEMP_DIR_URI . '/css/style.css', [], 1.0);
        wp_enqueue_style( 'my_google_fonts', 'https://fonts.googleapis.com/css2?family=Lora:wght@400;500&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,400&display=swap',array(), null );
        
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'my_boostrap.js', TEMP_DIR_URI . '/js/bootstrap.js', ['jquery'], 5.1, true );
        wp_enqueue_script('my_slider.js', TEMP_DIR_URI . '/js/paperstack.js', ['jquery'], 1.0, true );
        wp_enqueue_script( 'my_script.js', TEMP_DIR_URI.'/js/script.js', ['jquery'],  1.0, true );
    }

    add_action('wp_enqueue_scripts', 'my_add_static_files');
}



// adding title tag
if(!function_exists('my_theme_support')){

    function my_theme_support(){

        add_theme_support('title-tag');

        add_theme_support( 'custom-logo', array(
            'height' => 150,
            'width'  => 100,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array( 'site-title', 'site-description' ),
            'unlink-homepage-logo' => true
        ) );

        add_theme_support('post-formats', [
            'aside',
            'audio',
            'chat',
            'gallery',
            'image',
            'link',
            'quote',
            'status',
            'video',
            ]);

        add_theme_support('post-thumbnails');

        add_theme_support('post-formats');

        add_theme_support('align-wide');

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'custom-background', ['default-color'=> '#121212'] );



    }

    add_action( 'after_setup_theme', 'my_theme_support');
    

}


// styling menus
add_filter( 'nav_menu_link_attributes', function($atts) {
    $atts['class'] = "nav-link m-link";
    return $atts;
}, 100, 1 );

add_filter( 'nav_menu_css_class', function($classes) {
    $classes[] = 'nav-item';
    return $classes;
}, 10, 1 );

?>

