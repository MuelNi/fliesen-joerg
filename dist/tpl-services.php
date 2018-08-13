<?php
// Template Name: Services
?>
<?php get_header(); ?>

<?php
function create_services( ) {

    $query = new WP_Query(array(
        'post_type' => 'services',
        'orderby' => title,
        'order' => 'ASC'));

    $output = '';

    $counter = 0;

    if ($query->have_posts()) {

        while ($query->have_posts())  {

            $query->the_post();
            $counter++;

            if ($counter % 2 != 0) {
                $output .=  ''       
                . '<div class="row row-eq-height align-items-center service-container">'
                    . '<div class="col-12 col-lg-6 service-image">'
                        . '<img src="' . get_field('service_image')['url'] . '" class="img-fluid">'
                    . '</div>'
                    . '<div class="col-12 col-lg-6 service-description">'
                        . '<img src="' . get_field('service_icon')['url'] . '">'
                        . '<h3>' . get_the_title() . '</h3>'
                        . '<p>' . get_field('service_description') . '</p>'
                    . '</div>'
                . '</div>';
            } else {
                $output .=  ''       
                . '<div class="row row-eq-height align-items-center service-container">'
                    . '<div class="col-12 col-lg-6 order-lg-12 service-image">'
                        . '<img src="' . get_field('service_image')['url'] . '" class="img-fluid">'
                    . '</div>'
                    . '<div class="col-12 col-lg-6 order-lg-1 service-description">'
                        . '<img src="' . get_field('service_icon')['url'] . '">'
                        . '<h3>' . get_the_title() . '</h3>'
                        . '<p>' . get_field('service_description') . '</p>'
                    . '</div>'
                . '</div>';
            }
        }
    } else {
        return "No Posts";
    }

    return $output;
}
$content = create_services();
?>

<div class="container services">
    <div class="row">
        <h1>Unsere Services auf einem Blick</h1>
    </div>
    <?php echo $content; ?>
</div>

<?php get_footer(); ?>