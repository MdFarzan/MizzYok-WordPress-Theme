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


        // footer
        register_sidebar( array(
            'name'          => __( 'Footer', TEXT_DOMAIN ),
            'id'            => 'footer-widgets',
            'before_widget' => '<div id="%1$s" class="col-md-4 col-lg-3 %2$s">',
            'after_widget'  => '</div>',
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



// customizing functionality
if(!function_exists('my_customize_register')){

    function my_customize_register($wp_customize){

        // adding panel for theme options
        $wp_customize->add_panel('theme_options', [
            'title' => 'Theme Options',
            'Description' => 'Add content in your theme here',
            'priority' => 40,
            'capability'     => 'edit_theme_options'
        ]);

        # hero section starts
        $wp_customize->add_section('hero_section', [
            'title' => __('Hero Section', TEXT_DOMAIN),
            'description' => __('Add/Update content of Hero section here', TEXT_DOMAIN),
            'panel' => 'theme_options'
        ]);


        $wp_customize->add_setting( 'hero_heading', array(
            'type'                 => 'theme_mod',
            'default'              => 'We Create <br> Your Brand, Your Story',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'sanitize_url_text'
        ) );

        
        $wp_customize->add_control( 'hero_heading', array(
            'label'       => __( 'Hero title', TEXT_DOMAIN ),
            'section'     => 'hero_section',
            'type'        => 'text'
        ) );


        $wp_customize->add_setting( 'hero_desc', array(
            'type'                 => 'theme_mod',
            'default'              => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo nisi quisquam architecto ab cumque atque consequuntur.',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ) );

        
        $wp_customize->add_control( 'hero_desc', array(
            'label'       => __( 'Hero Description', TEXT_DOMAIN ),
            'section'     => 'hero_section',
            'type'        => 'textarea'
        ) );


        // Setting: Checkbox.
        $wp_customize->add_setting( 'cta_btn', array(
            'type'                 => 'theme_mod',
            'default'              => 'enable',
            'transport'            => 'refresh', 
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => '' 
        ) );

        // continue from sanitizing checkbox
        // Control: Checkbox.
        $wp_customize->add_control( 'cta_btn', array(
            'label'       => __( 'Show CTA button', TEXT_DOMAIN ),
            'description' => __( 'Show/Hide CTA button', TEXT_DOMAIN ),
            'section'     => 'hero_section',
            'type'        => 'checkbox'
        ) );

        $wp_customize->add_setting( 'cta_label', array(
            'type'                 => 'theme_mod',
            'default'              => 'BUTTON TEXT',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ) );

        
        $wp_customize->add_control( 'cta_label', array(
            'label'       => __( 'CTA button Label', TEXT_DOMAIN ),
            'section'     => 'hero_section',
            'type'        => 'text'
        ) );

        $wp_customize->add_setting( 'cta_link', array(
            'type'                 => 'theme_mod',
            'default'              => '#',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'esc_url_raw'
        ) );

        
        $wp_customize->add_control( 'cta_link', array(
            'label'       => __( 'CTA button link', TEXT_DOMAIN ),
            'section'     => 'hero_section',
            'type'        => 'text'
        ) );


        $wp_customize->add_setting( 'hero_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'hero_img', 
                array(
                    'label'      => __( 'Hero Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 620px x 542px'),
                    'section'    => 'hero_section',
                    'settings'   => 'hero_img',
                    
                ) ) 
        );

        $wp_customize->add_setting( 'hero_img_alt', array(
            'type'                 => 'theme_mod',
            'default'              => 'image',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ) );

        
        $wp_customize->add_control( 'hero_img_alt', array(
            'label'       => __( 'Image ALT text', TEXT_DOMAIN ),
            'section'     => 'hero_section',
            'type'        => 'text'
        ) );

        #hero section ends


        # about section starts
        $wp_customize->add_section('about_section', [
            'title' => __('About Section', TEXT_DOMAIN),
            'description' => __('Add/Update content of about section here', TEXT_DOMAIN),
            'panel' => 'theme_options'
        ]);

        $wp_customize->add_setting( 'about_sub_title', array(
            'type'                 => 'theme_mod',
            'default'              => 'Section sub title',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ) );

        
        $wp_customize->add_control( 'about_sub_title', array(
            'label'       => __( 'About Sub Title', TEXT_DOMAIN ),
            'section'     => 'about_section',
            'type'        => 'text'
        ) );

        $wp_customize->add_setting('about_title', [
            'type' => 'theme_mod',
            'default' => 'section title',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('about_title', [
            'label' => __('About Title', TEXT_DOMAIN),
            'section' => 'about_section',
            'type' => 'text'
        ]);

        $wp_customize->add_setting('about_desc',[
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('about_desc', [
            'label' => __('Description', TEXT_DOMAIN),
            'description' => __('Add your description here', TEXT_DOMAIN),
            'type' => 'textarea',
            'section' => 'about_section'
        ]);


        $wp_customize->add_setting( 'about_btn', array(
            'type'                 => 'theme_mod',
            'default'              => 'enable',
            'transport'            => 'refresh', 
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => '' 
        ) );

        // continue from sanitizing checkbox
        // Control: Checkbox.
        $wp_customize->add_control( 'about_btn', array(
            'label'       => __( 'Show button', TEXT_DOMAIN ),
            'description' => __( 'Show/Hide button', TEXT_DOMAIN ),
            'section'     => 'about_section',
            'type'        => 'checkbox'
        ) );

        $wp_customize->add_setting( 'about_btn_label', array(
            'type'                 => 'theme_mod',
            'default'              => 'BUTTON TEXT',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ) );

        
        $wp_customize->add_control( 'about_btn_label', array(
            'label'       => __( 'Button Label', TEXT_DOMAIN ),
            'section'     => 'about_section',
            'type'        => 'text'
        ) );

        $wp_customize->add_setting( 'about_btn_link', array(
            'type'                 => 'theme_mod',
            'default'              => '#',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'esc_url_raw'
        ) );

        
        $wp_customize->add_control( 'about_btn_link', array(
            'label'       => __( 'Button link', TEXT_DOMAIN ),
            'section'     => 'hero_section',
            'type'        => 'text'
        ) );


        $wp_customize->add_setting( 'about_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'about_img', 
                array(
                    'label'      => __( 'Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 560px x 570px'),
                    'section'    => 'about_section',
                    'settings'   => 'about_img',
                    
                ) ) 
        );

        $wp_customize->add_setting( 'about_img_alt', array(
            'type'                 => 'theme_mod',
            'default'              => 'image',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ) );

        
        $wp_customize->add_control( 'about_img_alt', array(
            'label'       => __( 'Image ALT text', TEXT_DOMAIN ),
            'section'     => 'about_section',
            'type'        => 'text'
        ) );

        #about section ends


    }

    add_action( 'customize_register', 'my_customize_register' );

}


// sanitizing functions

if(!function_exists('sanitize_url_text')){
    function sanitize_url_text($text){
        return $text;
    }
}


if(!function_exists('my_sanitize_checkbox')){

    function my_sanitize_checkbox($input){
        return ( isset( $input ) ? true : false );
        
    }

}

if(!function_exists('my_sanitize_img')){

    function my_sanitize_img($file, $setting){

        //allowed file types
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png'
        );
        
        //check file type from file name
        $file_ext = wp_check_filetype( $file, $mimes );
        
        //if file has a valid mime type return it, otherwise return default
        return ( $file_ext['ext'] ? $file : $setting->default );

    }

}

?>

