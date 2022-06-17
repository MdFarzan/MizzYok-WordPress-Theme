<?php 

/* 
    index.php
    blog page for the theme

*/

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

                    <?php 

                        if(have_posts()){

                            while(have_posts()){



                                the_post();

                                $post_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                    
                    ?>

                    <div class="col-md-6 col-lg-4 col-xl-3 article">
                        <div class="artcl-wrap">
                            <div class="artcl-thumb">
                                
                                

                                <img src="<?php echo $post_img[0]; ?>" class="img-fluid">
                            </div>
                            <div class="artcl-meta">
                                <span class="date"><?php echo the_author().' | '; ?></span>
                                <span class="author"><?php echo get_the_date(); ?></span>
                            </div>
                            <h2 class="artcl-title"><?php echo the_title(); ?></h2>
                            <p class="artcl-desc">
                            <?php echo substr(strip_tags(get_the_excerpt()), 0, 150).' ...'; ?>
                            </p>
                            <div class="read-more-con text-center">
                                <a href="<?php echo the_permalink(); ?>" class="read-more-btn">Read More</a>
                            </div>
                        </div>
                    </div>

                    
                    <?php 

                                }

                            }

                        else{
                            echo '<p class="text-center">No Post Available!</p>';
                        }
                    
                    ?>
                   
                    </div>  
                </div>
            </div>
        </div>

    </div>
</body>

<?php get_footer(); ?>