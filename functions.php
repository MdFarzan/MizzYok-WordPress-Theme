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

        wp_enqueue_script('jquery');
        wp_enqueue_script( 'my_boostrap.js', TEMP_DIR_URI . '/js/bootstrap.js', ['jquery'], 5.1, true );
        wp_enqueue_script('my_slider.js', TEMP_DIR_URI . '/js/paperstack.js', ['jquery'], 1.0, true );
        wp_enqueue_script( 'my_script.js', TEMP_DIR_URI.'/js/script.js', ['jquery'],  1.0, true );
    }

    add_action('wp_enqueue_scripts', 'my_add_static_files');
}

?>