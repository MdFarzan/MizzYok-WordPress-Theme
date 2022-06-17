<?php 

    /* 
        page.php
        page for single blog
    */
    the_post();
    require_once('template-parts/head.php');
?>

<body class="prim-bg <?php body_class('prim-bg') ?>">
    <?php  wp_body_open(); ?>
    <!-- body starts -->
    <div id="wrapper">
        <div class="container">
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
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="post-feature-img">
                             <?php echo the_post_thumbnail('full') ?>
                        </div>
                        <div class="artcl-meta">
                            <span class="date"><?php echo get_the_author().' | '; ?></span>
                            <span class="author"><?php echo get_the_date(); ?></span>
                        </div>

                        <div class="post-content">
                            <?php
                                echo the_content();
                            ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <?php dynamic_sidebar('blog-sidebar'); ?>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</body>

<?php get_footer(); ?>