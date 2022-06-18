<?php 

    /* 
    page-title.php
    contains inner page title template
    */

?>

<!-- title content starts -->
<div class="page-title">
        <div class="ct-container py-4 py-md-5">
            <h1><?php if(get_post_type() === 'post' && is_single()){
                echo the_title();
            } 
            
            else
            wp_title('', true); ?></h1>
        </div>
</div>
<!-- title content ends -->