<?php
/**
 * Template part for displaying the main slider
 */
?>

<div class="flexslider">
    <ul class="slides">
        <?php 
        // Example static slides - you can replace this with a custom post type or ACF later
        $slides = array(
            array(
                'image' => get_template_directory_uri() . '/assets/images/slide1.jpg',
                'title' => __('First Slide', 'monalisa'),
                'description' => __('Your slide description here', 'monalisa')
            ),
            array(
                'image' => get_template_directory_uri() . '/assets/images/slide2.jpg',
                'title' => __('Second Slide', 'monalisa'),
                'description' => __('Another slide description', 'monalisa')
            )
        );

        foreach ($slides as $slide) : ?>
            <li>
                <img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['title']); ?>" />
                <?php if (!empty($slide['title']) || !empty($slide['description'])) : ?>
                    <div class="flex-caption">
                        <?php if (!empty($slide['title'])) : ?>
                            <h3><?php echo esc_html($slide['title']); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($slide['description'])) : ?>
                            <p><?php echo esc_html($slide['description']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
