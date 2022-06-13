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


?>