<?php
// Template Name: Home
?>
<?php get_header(); ?>

<?php
$overline = get_field('home_body_overline');
$subline = get_field('home_body_suboverline');
$overlineSecond = get_field('home_second_body_overline'); 
?>

<div class="container-fluid container-fluid-bg">
    <div class="container container-home-box-transp">
        <div class="row">
            <div class="container-overline"> 
                <h1 style="padding-top: 30px;"> 
                    <?php echo $overline; ?>  
                </h1>
            </div>
            <div class="container-overline"> 
                <h3> 
                    <?php echo $subline; ?>
                </h3>
            </div>
        </div>
        <div class="row home-box-bg">   
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>/partner" ><img src="<?php bloginfo('template_directory'); ?>/img/partner.png" alt="Partner"  height="150" width="150"></a>
        </div>
        <div class="row">
            
        </div>
    </div>
    <div class="container container-home-box-transp">
        <div class="row">
            <div class="container-overline"> 
                <h2 style="padding-top: 30px;"> 
                    <?php echo $overlineSecond; ?>  
                </h2>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
