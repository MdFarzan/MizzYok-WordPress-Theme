<?php 

/* 
    Template Name: Home Template
*/

require_once('constant.php');
$stat_bg =  get_theme_mod('stat_bg', '');







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
<body class="prim-bg <?php body_class('prim-bg') ?>">
    <?php  wp_body_open(); ?>
    <!-- body starts -->
    <div id="wrapper">
        <div class="container">
            <div class="hero">
                <header>
                    <?php get_header(); ?>

                    <!-- hero content starts -->
                    <section>
                        <div class="container">
                            <div class="row flex-column-reverse flex-md-row ">
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="hero-content-wrapper py-2 text-center text-md-start">
                                        <h1>
                                            <?php echo get_theme_mod('hero_heading', 'We Create <br> Your Brand, Your Ideantity'); ?>
                                        </h1>
                                        <p class="pt-1 pb-3">
                                            <?php echo get_theme_mod('hero_desc', 'Your description here'); ?>
                                            
                                        </p>
                                        <?php if(get_theme_mod('cta_btn') == true){ ?>

                                            <a class="prim-btn" href="<?php echo get_theme_mod('cta_link', '#'); ?>"><span class="btn-text"><?php echo get_theme_mod('cta_label', 'BUTTON TEXT'); ?></span></a>
                                        
                                        <?php }                                         
                                        
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <div class="hero-img">
                                        <img src="<?php echo get_theme_mod('hero_img','#'); ?>" class="img-fluid" alt="<?php echo get_theme_mod('hero_img_alt', 'image'); ?>" />
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- hero content ends -->
                </header>
            </div>
        </div>

        <!-- spacing -->
        
        <section class="about-us">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-5 g-0 align-items-center">
                        <div class="about-content v-align-middle img-content text-center text-lg-start">
                            <img src="<?php echo get_theme_mod('about_img','#') ?>" class="img-fluid" alt="<?php echo get_theme_mod('about_img_alt', 'image') ?>" />
                        </div>
                    </div>
                    <div class="col-md-7 d-flex align-items-center">
                        <div class="about-content text-content">
                            <span class="sub-heading text-center text-md-start"><?php echo get_theme_mod('about_sub_title', 'Sub Title'); ?></span>
                            <h2 class="text-center text-md-start"><?php echo get_theme_mod('about_title', 'Section Title'); ?></h2>
                            <p class="pt-3 pb-2">
                                <?php echo get_theme_mod('about_desc', ''); ?>
                                
                            </p>
                            <div class="text-center text-md-start">
                                <?php
                                    if(get_theme_mod('about_btn') == true){
                                ?>
                                <a class="prim-btn sec-btn" href="<?php echo  get_theme_mod('about_btn_link', '#'); ?>"><span class="btn-text"><?php echo get_theme_mod('about_btn_label', 'Button Label'); ?></span></a>

                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="services">
            <div class="container">
                <div class="sec-title title-center">
                    <span class="sub-heading"><?php echo get_theme_mod('service_sub_title', ''); ?></span>
                    <h2><?php echo get_theme_mod('service_title', ''); ?></h2>
                    <p class="sec-desc">
                        <?php echo get_theme_mod('services_desc', ''); ?>
                    </p>
                </div>
                <div class="services">
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="icon-desc-box">
                                <span class="corner left-top"></span>
                                <span class="corner left-left"></span>
                                <span class="corner bottom-bottom"></span>
                                <span class="corner right-right"></span>
                                <span class="icon"><img src="<?php echo get_theme_mod('service1_img', ''); ?>" alt="icon"></span>
                                <h3><?php echo get_theme_mod('service1_title', ''); ?></h3>
                                <p class="service-desc">
                                <?php echo get_theme_mod('service1_desc', ''); ?>
                                </p>
                                <a href="<?php echo get_theme_mod('service1_btn_link', '#'); ?>">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="icon-desc-box">
                                <span class="corner left-top"></span>
                                <span class="corner left-left"></span>
                                <span class="corner bottom-bottom"></span>
                                <span class="corner right-right"></span>
                                <span class="icon"><img src="<?php echo get_theme_mod('service2_img', ''); ?>" alt="icon"></span>
                                <h3><?php echo get_theme_mod('service2_title', ''); ?></h3>
                                <p class="service-desc">
                                <?php echo get_theme_mod('service2_desc', ''); ?>
                                </p>
                                <a href="<?php echo get_theme_mod('service2_btn_link', '#'); ?>">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="icon-desc-box">
                                <span class="corner left-top"></span>
                                <span class="corner left-left"></span>
                                <span class="corner bottom-bottom"></span>
                                <span class="corner right-right"></span>
                                <span class="icon"><img src="<?php echo get_theme_mod('service3_img', ''); ?>" alt="icon"></span>
                                <h3><?php echo get_theme_mod('service3_title', ''); ?></h3>
                                <p class="service-desc">
                                    <?php echo get_theme_mod('service3_desc', ''); ?>
                                </p>
                                <a href="<?php echo get_theme_mod('service3_btn_link', '#'); ?>">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="icon-desc-box">
                                <span class="corner left-top"></span>
                                <span class="corner left-left"></span>
                                <span class="corner bottom-bottom"></span>
                                <span class="corner right-right"></span>
                                <span class="icon"><img src="<?php echo get_theme_mod('service4_img', ''); ?>" alt="icon"></span>
                                <h3><?php echo get_theme_mod('service4_title', ''); ?></h3>
                                <p class="service-desc">
                                <?php echo get_theme_mod('service4_desc', ''); ?>
                                </p>
                                <a href="<?php echo get_theme_mod('service4_btn_link','#'); ?>">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="icon-desc-box">
                                <span class="corner left-top"></span>
                                <span class="corner left-left"></span>
                                <span class="corner bottom-bottom"></span>
                                <span class="corner right-right"></span>
                                <span class="icon"><img src="<?php echo get_theme_mod('service5_img', ''); ?>" alt="icon"></span>
                                <h3><?php echo get_theme_mod('service5_title', ''); ?></h3>
                                <p class="service-desc">
                                <?php echo get_theme_mod('service5_desc', ''); ?>
                                </p>
                                <a href="<?php echo get_theme_mod('service5_btn_link', '#'); ?>">Read More</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="icon-desc-box">
                                <span class="corner left-top"></span>
                                <span class="corner left-left"></span>
                                <span class="corner bottom-bottom"></span>
                                <span class="corner right-right"></span>
                                <span class="icon"><img src="<?php echo get_theme_mod('service6_img', ''); ?>" alt="icon"></span>
                                <h3><?php echo get_theme_mod('service6_title', ''); ?></h3>
                                <p class="service-desc">
                                    <?php echo get_theme_mod('service6_desc', ''); ?>
                                </p>
                                <a href="<?php echo get_theme_mod('service6_btn_link', '#'); ?>">Read More</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <div class="statistics-wrap" style="background-image:url('<?php echo get_theme_mod('stat_bg', '') ; ?>;')">
            <section class="statistics">
                
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 py-3">
                                <div class="stat-box">
                                    <div class="icon-stat">
                                        <span class="icon"><img src="<?php echo get_theme_mod('stat1_img', ''); ?>" alt="icon"></span><span class="stat"><?php echo get_theme_mod('stat1_num', ''); ?><strong>+</strong></span>
                                    </div>
                                    <p><?php echo get_theme_mod('stat1_title', ''); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 py-3">
                                <div class="stat-box">
                                    <div class="icon-stat">
                                        <span class="icon"><img src="<?php echo get_theme_mod('stat2_img', ''); ?>" alt="icon"></span><span class="stat"><?php echo get_theme_mod('stat2_num', ''); ?><strong>+</strong></span>
                                    </div>
                                    <p><?php echo get_theme_mod('stat2_title', ''); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 py-3">
                                <div class="stat-box">
                                    <div class="icon-stat">
                                        <span class="icon"><img src="<?php echo get_theme_mod('stat3_img', ''); ?>" alt="icon"></span><span class="stat"><?php echo get_theme_mod('stat3_num', ''); ?><strong>+</strong></span>
                                    </div>
                                    <p><?php echo get_theme_mod('stat3_title', ''); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 py-3">
                                <div class="stat-box">
                                    <div class="icon-stat">
                                        <span class="icon"><img src="<?php echo get_theme_mod('stat4_img', ''); ?>" alt="icon"></span><span class="stat"><?php echo get_theme_mod('stat4_num', ''); ?><strong>+</strong></span>
                                    </div>
                                    <p><?php echo get_theme_mod('stat4_title', ''); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </section>
        </div>

        <section class="testimonial-slider">
            <div class="container">
                <div class="test-slider-wrapper">
                    <div class="stack">
                        <div class="sheet">
                            <div class="sheet-wrapper">
                                <span class="test-avtar"><img src="<?php echo get_theme_mod('avtar1'); ?>" alt="avtar 1" /></span>
                                <p><?php echo get_theme_mod('review1_desc', ''); ?></p>
                                <div class="test-credits">
                                    <h5><?php echo get_theme_mod('review1_name', ''); ?></h5>
                                    <p><?php echo get_theme_mod('review1_busi', ''); ?></p>
                                </div>
                            </div>
                        </div>
        
                        <div class="sheet">
                            <div class="sheet-wrapper">
                                <span class="test-avtar"><img src="<?php echo get_theme_mod('avtar2'); ?>" alt="avtar 2" /></span>
                                <p><?php echo get_theme_mod('review2_desc', ''); ?></p>
                                <div class="test-credits">
                                    <h5><?php echo get_theme_mod('review2_name', ''); ?></h5>
                                    <p><?php echo get_theme_mod('review2_busi', ''); ?></p>
                                </div>
                            </div>
                        </div>
        
                        <div class="sheet">
                            <div class="sheet-wrapper">
                                <span class="test-avtar"><img src="<?php echo get_theme_mod('avtar3'); ?>" alt="avtar 3" /></span>
                                <p><?php echo get_theme_mod('review3_desc', ''); ?></p>
                                <div class="test-credits">
                                    <h5><?php echo get_theme_mod('review3_name', ''); ?></h5>
                                    <p><?php echo get_theme_mod('review3_busi', ''); ?></p>
                                </div>
                            </div>
                        </div>
        
                        <div class="sheet">
                            <div class="sheet-wrapper">
                                <span class="test-avtar"><img src="<?php echo get_theme_mod('avtar4'); ?>" alt="avtar 4" /></span>
                                <p><?php echo get_theme_mod('review4_desc', ''); ?></p>
                                <div class="test-credits">
                                    <h5><?php echo get_theme_mod('review4_name', ''); ?></h5>
                                    <p><?php echo get_theme_mod('review4_busi', ''); ?></p>
                                </div>
                            </div>
                        </div>
        
                        <div class="sheet">
                            <div class="sheet-wrapper">
                                <span class="test-avtar"><img src="<?php echo get_theme_mod('avtar5'); ?>" alt="avtar 5" /></span>
                                <p><?php echo get_theme_mod('review5_desc', ''); ?></p>
                                <div class="test-credits">
                                    <h5><?php echo get_theme_mod('review5_name', ''); ?></h5>
                                    <p><?php echo get_theme_mod('review5_busi', ''); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="sheet">
                            <div class="sheet-wrapper">
                                <span class="test-avtar"><img src="<?php echo get_theme_mod('avtar6'); ?>" alt="avtar 6" /></span>
                                <p><?php echo get_theme_mod('review6_desc', ''); ?></p>
                                <div class="test-credits">
                                    <h5><?php echo get_theme_mod('review6_name', ''); ?></h5>
                                    <p><?php echo get_theme_mod('review6_busi', ''); ?></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <a id="prev" href="javascript::void(0)"><img src="<?php echo TEMP_DIR_URI; ?>/img/left-arrow.png" alt="swipe-left" /> </a>
                    <a id="next" href="javascript::void(0)"><img src="<?php echo TEMP_DIR_URI; ?>/img/right-arrow.png" alt="swipe-right" /> </a>
                </div>
            </div>
        </section>

        <section class="cta-wrap">
            <div class="cta">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-lg-8 text-center text-md-start">
                            <h3>Lorem ipsum dolor sit amet</h3>
                            <p> consectetur adipisicing elit Id consequatur in ab placeat officiis nesciunt dolorem.</p>
                        </div>
                        <div class="col-md-4 col-lg-4 d-flex justify-content-end align-items-center justify-content-center">
                            <a class="prim-btn sec-btn mt-4 mt-md-0"><span class="btn-text">Contact Us</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php get_footer(); ?>
    <!-- body ends -->
    </div>
    


    <?php wp_footer(); ?>

</body>
</html>