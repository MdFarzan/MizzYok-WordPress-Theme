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
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );


        // footer
        register_sidebar( array(
            'name'          => __( 'Footer', TEXT_DOMAIN ),
            'id'            => 'footer-widgets',
            'before_widget' => '<div id="%1$s" class="col-md-6 col-lg-3 %2$s py-3 py-md-1 text-sm-center text-md-start">',
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

        #service section starts
        
        $wp_customize->add_section('services_section', [
            'title' => __('Services Section', TEXT_DOMAIN),
            'description' => __('Add/Update content of services section here', TEXT_DOMAIN),
            'panel' => 'theme_options'
        ]);


        $wp_customize->add_setting('service_sub_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service_sub_title', [
            'type' => 'text',
            'label' => __('Sub Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);


        $wp_customize->add_setting('service_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service_title', [
            'type' => 'text',
            'label' => __('Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        $wp_customize->add_setting('services_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('services_desc', [
            'type' => 'textarea',
            'label' => __('Description', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        // service 1 starts

        $wp_customize->add_setting('service1_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service1_title', [
            'type' => 'text',
            'label' => __('Service-1: Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);



        $wp_customize->add_setting('service1_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service1_desc', [
            'type' => 'textarea',
            'label' => __('Service-1: Description', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        $wp_customize->add_setting( 'service1_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'service1_img', 
                array(
                    'label'      => __( 'Service:1 Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'services_section',
                    'settings'   => 'service1_img',
                    
                ) ) 
        );

        $wp_customize->add_setting('service1_btn_link', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service1_btn_link', [
            'type' => 'text',
            'label' => __('Service 1: Link', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        // service 1 ends

        // service 2 starts

        $wp_customize->add_setting('service2_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service2_title', [
            'type' => 'text',
            'label' => __('Service-2: Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);



        $wp_customize->add_setting('service2_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service2_desc', [
            'type' => 'textarea',
            'label' => __('Service-2: Description', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        $wp_customize->add_setting( 'service2_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'service2_img', 
                array(
                    'label'      => __( 'Service:2 Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'services_section',
                    'settings'   => 'service2_img',
                    
                ) ) 
        );

        $wp_customize->add_setting('service2_btn_link', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service2_btn_link', [
            'type' => 'text',
            'label' => __('Service 2: Link', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        // service 2 ends

        // service 3 starts

        $wp_customize->add_setting('service3_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service3_title', [
            'type' => 'text',
            'label' => __('Service-3: Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);



        $wp_customize->add_setting('service3_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service3_desc', [
            'type' => 'textarea',
            'label' => __('Service-3: Description', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        $wp_customize->add_setting( 'service3_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'service3_img', 
                array(
                    'label'      => __( 'Service:3 Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'services_section',
                    'settings'   => 'service3_img',
                    
                ) ) 
        );

        $wp_customize->add_setting('service3_btn_link', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service3_btn_link', [
            'type' => 'text',
            'label' => __('Service 3: Link', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        // service 3 ends

        // service 4 starts

        $wp_customize->add_setting('service4_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service4_title', [
            'type' => 'text',
            'label' => __('Service-4: Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);



        $wp_customize->add_setting('service4_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service4_desc', [
            'type' => 'textarea',
            'label' => __('Service-4: Description', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        $wp_customize->add_setting( 'service4_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'service4_img', 
                array(
                    'label'      => __( 'Service:4 Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'services_section',
                    'settings'   => 'service4_img',
                    
                ) ) 
        );

        $wp_customize->add_setting('service4_btn_link', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service4_btn_link', [
            'type' => 'text',
            'label' => __('Service 4: Link', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        // service 4 ends

        // service 5 starts

        $wp_customize->add_setting('service5_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service5_title', [
            'type' => 'text',
            'label' => __('Service-5: Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);



        $wp_customize->add_setting('service5_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service5_desc', [
            'type' => 'textarea',
            'label' => __('Service-5: Description', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        $wp_customize->add_setting( 'service5_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'service5_img', 
                array(
                    'label'      => __( 'Service:5 Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'services_section',
                    'settings'   => 'service5_img',
                    
                ) ) 
        );

        $wp_customize->add_setting('service5_btn_link', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service5_btn_link', [
            'type' => 'text',
            'label' => __('Service 5: Link', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        // service 5 ends

        // service 6 starts

        $wp_customize->add_setting('service6_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service6_title', [
            'type' => 'text',
            'label' => __('Service-6: Title', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);



        $wp_customize->add_setting('service6_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service6_desc', [
            'type' => 'textarea',
            'label' => __('Service-6: Description', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        $wp_customize->add_setting( 'service6_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'service6_img', 
                array(
                    'label'      => __( 'Service:6 Image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'services_section',
                    'settings'   => 'service6_img',
                    
                ) ) 
        );

        $wp_customize->add_setting('service6_btn_link', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('service6_btn_link', [
            'type' => 'text',
            'label' => __('Service 6: Link', TEXT_DOMAIN),
            'section'=> 'services_section'
        ]);

        // service 6 ends
        #sevice section ends
        
        
        # statistics section starts

        $wp_customize->add_section('stat_section', [
            'title' => __('Statistics Section', TEXT_DOMAIN),
            'description' => __('Add/Update content of statistics section here', TEXT_DOMAIN),
            'panel' => 'theme_options'
        ]);


        $wp_customize->add_setting( 'stat_bg', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'stat_bg', 
                array(
                    'label'      => __( 'Section background Image', TEXT_DOMAIN ),
                    'description' => __('Select background image for statistics section'),
                    'section'    => 'stat_section',
                    'settings'   => 'stat_bg',
                    
                ) ) 
        );


        // stat1 starts
        $wp_customize->add_setting( 'stat1_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'stat1_img', 
                array(
                    'label'      => __( 'Stat 1: icon/image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'stat_section',
                    'settings'   => 'stat1_img',
                    
                ) ) 
        );


        $wp_customize->add_setting('stat1_num', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat1_num', [
            'type' => 'text',
            'label' => __('Stat 1: Number', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);

        $wp_customize->add_setting('stat1_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat1_title', [
            'type' => 'text',
            'label' => __('Stat 1: Title', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);
        // stat1 ends

        // stat2 starts
        $wp_customize->add_setting( 'stat2_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'stat2_img', 
                array(
                    'label'      => __( 'Stat 2: icon/image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'stat_section',
                    'settings'   => 'stat2_img',
                    
                ) ) 
        );


        $wp_customize->add_setting('stat2_num', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat2_num', [
            'type' => 'text',
            'label' => __('Stat 2: Number', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);

        $wp_customize->add_setting('stat2_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat2_title', [
            'type' => 'text',
            'label' => __('Stat 2: Title', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);
        // stat2 ends

        // stat3 starts
        $wp_customize->add_setting( 'stat3_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'stat3_img', 
                array(
                    'label'      => __( 'Stat 3: icon/image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'stat_section',
                    'settings'   => 'stat3_img',
                    
                ) ) 
        );


        $wp_customize->add_setting('stat3_num', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat3_num', [
            'type' => 'text',
            'label' => __('Stat 3: Number', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);

        $wp_customize->add_setting('stat3_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat3_title', [
            'type' => 'text',
            'label' => __('Stat 3: Title', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);
        // stat3 ends

        // stat4 starts
        $wp_customize->add_setting( 'stat4_img', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'stat4_img', 
                array(
                    'label'      => __( 'Stat 4: icon/image', TEXT_DOMAIN ),
                    'description' => __('Recommended size 512px x 512px'),
                    'section'    => 'stat_section',
                    'settings'   => 'stat4_img',
                    
                ) ) 
        );


        $wp_customize->add_setting('stat4_num', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat4_num', [
            'type' => 'text',
            'label' => __('Stat 4: Number', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);

        $wp_customize->add_setting('stat4_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('stat4_title', [
            'type' => 'text',
            'label' => __('Stat 4: Title', TEXT_DOMAIN),
            'section'=> 'stat_section'
        ]);
        // stat4 ends

        # statistics section ends

        # testimonial starts

        $wp_customize->add_section('testimonial_section', [
            'title' => __('Testimonial Section', TEXT_DOMAIN),
            'description' => __('Add/Update content of Testimonials here', TEXT_DOMAIN),
            'panel' => 'theme_options'
        ]);

        //  review1 starts
        $wp_customize->add_setting( 'avtar1', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'avtar1', 
                array(
                    'label'      => __( 'Client 1: Avtar/Picture ', TEXT_DOMAIN ),
                    'description' => __('Recommended size 100px x 100px'),
                    'section'    => 'testimonial_section',
                    'settings'   => 'avtar1',
                    
                ) ) 
        );
        

        $wp_customize->add_setting('review1_name', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review1_name', [
            'type' => 'text',
            'label' => __('Client 1: Name', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review1_busi', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review1_busi', [
            'type' => 'text',
            'label' => __('Client 1: Business', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review1_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review1_desc', [
            'type' => 'textarea',
            'label' => __('Client 1: Description', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);
        // review1 ends

        //  review2 starts
        $wp_customize->add_setting( 'avtar2', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'avtar2', 
                array(
                    'label'      => __( 'Client 2: Avtar/Picture ', TEXT_DOMAIN ),
                    'description' => __('Recommended size 100px x 100px'),
                    'section'    => 'testimonial_section',
                    'settings'   => 'avtar2',
                    
                ) ) 
        );
        

        $wp_customize->add_setting('review2_name', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review2_name', [
            'type' => 'text',
            'label' => __('Client 2: Name', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review2_busi', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review2_busi', [
            'type' => 'text',
            'label' => __('Client 2: Business', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review2_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review2_desc', [
            'type' => 'textarea',
            'label' => __('Client 1: Description', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);
        // review2 ends

        //  review3 starts
        $wp_customize->add_setting( 'avtar3', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'avtar3', 
                array(
                    'label'      => __( 'Client 3: Avtar/Picture ', TEXT_DOMAIN ),
                    'description' => __('Recommended size 100px x 100px'),
                    'section'    => 'testimonial_section',
                    'settings'   => 'avtar3',
                    
                ) ) 
        );
        

        $wp_customize->add_setting('review3_name', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review3_name', [
            'type' => 'text',
            'label' => __('Client 3: Name', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review3_busi', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review3_busi', [
            'type' => 'text',
            'label' => __('Client 3: Business', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review3_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review3_desc', [
            'type' => 'textarea',
            'label' => __('Client 3: Description', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);
        // review3 ends

        //  review4 starts
        $wp_customize->add_setting( 'avtar4', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'avtar4', 
                array(
                    'label'      => __( 'Client 4: Avtar/Picture ', TEXT_DOMAIN ),
                    'description' => __('Recommended size 100px x 100px'),
                    'section'    => 'testimonial_section',
                    'settings'   => 'avtar4',
                    
                ) ) 
        );
        

        $wp_customize->add_setting('review4_name', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review4_name', [
            'type' => 'text',
            'label' => __('Client 4: Name', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review4_busi', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review4_busi', [
            'type' => 'text',
            'label' => __('Client 4: Business', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review4_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review4_desc', [
            'type' => 'textarea',
            'label' => __('Client 4: Description', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);
        // review4 ends

        //  review5 starts
        $wp_customize->add_setting( 'avtar5', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'avtar5', 
                array(
                    'label'      => __( 'Client 5: Avtar/Picture ', TEXT_DOMAIN ),
                    'description' => __('Recommended size 100px x 100px'),
                    'section'    => 'testimonial_section',
                    'settings'   => 'avtar5',
                    
                ) ) 
        );
        

        $wp_customize->add_setting('review5_name', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review5_name', [
            'type' => 'text',
            'label' => __('Client 5: Name', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review5_busi', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review5_busi', [
            'type' => 'text',
            'label' => __('Client 5: Business', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review5_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review5_desc', [
            'type' => 'textarea',
            'label' => __('Client 5: Description', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);
        // review5 ends

        //  review6 starts
        $wp_customize->add_setting( 'avtar6', array(
            'type'                 => 'theme_mod',
            'default'              => '',
            'transport'            => 'refresh', // Options: refresh or postMessage.
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'my_sanitize_img'
        ) );

        
        $wp_customize->add_control(
            new WP_Customize_Upload_Control( 
                $wp_customize, 
                'avtar6', 
                array(
                    'label'      => __( 'Client 6: Avtar/Picture ', TEXT_DOMAIN ),
                    'description' => __('Recommended size 100px x 100px'),
                    'section'    => 'testimonial_section',
                    'settings'   => 'avtar6',
                    
                ) ) 
        );
        

        $wp_customize->add_setting('review6_name', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review6_name', [
            'type' => 'text',
            'label' => __('Client 6: Name', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review6_busi', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review6_busi', [
            'type' => 'text',
            'label' => __('Client 6: Business', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);

        $wp_customize->add_setting('review6_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('review6_desc', [
            'type' => 'textarea',
            'label' => __('Client 6: Description', TEXT_DOMAIN),
            'section'=> 'testimonial_section'
        ]);
        // review6 ends

        # testimonial ends

        # cta starts
        $wp_customize->add_section('cta_section', [
            'title' => __('CTA', TEXT_DOMAIN),
            'description' => __('Add/Update content of CTA here', TEXT_DOMAIN),
            'panel' => 'theme_options'
        ]);

        $wp_customize->add_setting('cta_title', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('cta_title', [
            'type' => 'text',
            'label' => __('CTA Title', TEXT_DOMAIN),
            'section'=> 'cta_section'
        ]);

        $wp_customize->add_setting('cta_desc', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('cta_desc', [
            'type' => 'textarea',
            'label' => __('Descripition', TEXT_DOMAIN),
            'section'=> 'cta_section'
        ]);

        $wp_customize->add_setting('cta_btn_link', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'sanitize_url_text'
        ]);

        $wp_customize->add_control('cta_btn_link', [
            'type' => 'text',
            'label' => __('CTA Link', TEXT_DOMAIN),
            'section'=> 'cta_section'
        ]);

        $wp_customize->add_setting('cta_btn_label', [
            'type' => 'theme_mod',
            'default' => '',
            'transport' => 'refresh',
            'capability' => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses'
        ]);

        $wp_customize->add_control('cta_btn_label', [
            'type' => 'text',
            'label' => __('CTA Label', TEXT_DOMAIN),
            'section'=> 'cta_section'
        ]);

        # cta ends

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

