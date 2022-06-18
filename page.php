<?php 

    /* 
        page.php
        page for single page taxonimies
    */
    the_post();
    require_once('template-parts/head.php');
?>

<body class="prim-bg <?php body_class('prim-bg') ?>">
    <?php  wp_body_open(); ?>
    <!-- body starts -->
    <div id="wrapper">
        <div class="ct-container">
            <div class="hero">
                <header>
                    <?php
                        get_header(); 
                    ?>
                </header>
            </div>
        </div>
        <?php require_once('template-parts/page-title.php'); ?>

        <div class="page-content-wrap">
            <div class="ct-container">
                        

                <div class="post-content">
                    <?php
                        echo the_content();
                    ?>



                </div>
                   
                
            </div>
        </div>

    </div>
</body>

<?php get_footer(); ?>