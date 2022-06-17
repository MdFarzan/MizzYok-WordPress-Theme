<?php 
    /* 
        header.php
         this is theme header file contains menu
    */

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $site_description = get_bloginfo( 'description', 'display' ); 


?>

<nav class="navbar navbar-expand-lg prim-bg sec-font">
                        <div class="container-fluid">
                        <a class="navbar-brand tir-color" id="header-logo" href="#">
                            <?php 
                                if ( has_custom_logo() ) {
                                    echo '<a href="'. get_home_url() .'"><img id="header-logo" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
                                }
                                
                                if((get_theme_mod('header_text') !== 0) && (get_bloginfo('description') !== '')) {
                                    echo '<h1><a href="'. get_home_url() .'">'.get_bloginfo('name').'</a></h1>';
                                    echo '<p class="tagline">'.get_bloginfo('description').'</p>';
                                }
                            
                            ?>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><img src="<?php echo TEMP_DIR_URI. '/img/menu-icon.png' ?>"></span>
                        </button>
                        
                            <?php 
                                wp_nav_menu( [
                                    'theme_location' => 'primary_menu',
                                    'menu_class' => 'navbar-nav',
                                    'menu_id' => 'primary-menu',
                                    'container_class' => 'collapse navbar-collapse justify-content-end',
                                    'container_id' => 'navbarNav'
                                ] );
                            ?>
                        
                        </div>
                    </nav>


