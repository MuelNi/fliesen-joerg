<?php
// Template Name: Home
?>
<?php get_header(); ?>

<?php
$overline = get_field('home_body_overline');
$subline = get_field('home_body_suboverline');
$overlineSecond = get_field('home_second_body_overline');
$images = get_field('home_body_icon_galerie');
$text = get_field('home_body_text');
$exampleImage = get_field('home_vorher_nachher_example');
$exampleText = get_field('home_vorher_nachher_description');
?>



<div class="home-container">
    <div class="container container-wrapper">
        <div class="home-top">
            <div class="row headline">
                <div class="col-12">
                    <h1>
                        <?php echo $overline; ?>
                    </h1>
                </div>
            </div>
            <div class="row subline">
                <div class="col-12">
                    <h2>
                        <?php echo $subline; ?>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="home-badge">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>/partner" ><img src="<?php bloginfo('template_directory'); ?>/img/partner.png" alt="Partner"  height="150" width="150"></a>
                    </div>
                    <img src="/wp-content/themes/fliesen-joerg/img/home_cars.png" alt="fliesen-joerg" class="img-fluid img-responsive">
                </div>
            </div>
        </div>
        <div class="home-icon-galerie">
            <?php foreach( $images as $image ): ?>
                <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" class="home-icon" />
            <?php endforeach; ?>
        </div>
        <div class="home-bottom">
            <div class="row headline-second">
                <div class="col-12">
                    <h2>
                        <?php echo $overlineSecond; ?>
                    </h2>
                    <p>
                        <?php echo $text; ?>
                    </p>
                </div>
                <div class="col-12">
                    <img src="<?php echo $exampleImage['url']; ?>" alt="<?php echo $exampleImage['alt']; ?>" class="img-fluid img-responsive" />
                </div>
                <div class="col-12 example-link">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>referenzen">
                        <?php echo $exampleText; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
