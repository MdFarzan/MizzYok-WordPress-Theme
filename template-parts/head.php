<?php 

    /* 
        head.php
        contains head part of the theme
    */

?>

<!DOCTYPE html>
<html lang="<?php echo language_attributes(); ?>">
<head>

    
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- BOOTSTRAP CDNs -->
    

    <!-- GOOGLE FONTS CDN -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet" />  -->

    <?php wp_head(); ?>
</head>
