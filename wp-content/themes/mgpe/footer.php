<?php

/**
 * The template for displaying the footer.
 *
 *
 * @package MGPE
 * @subpackage MGPE
 * @since 1.0
 */

?>

        <div class="row footer">
            <div class="col-md-12">

                <div class="col-md-12 text-center">
                    <?php wp_nav_menu( array('menu' => 'Footer Menu' )); ?>
                    <ul class="footer-menu">
                        <?php foreach (get_field('social_media', 6) as $social => $value) :?>
                            <?php $image = $value['social_media_image'] ?>
                            <li><a href="<?php echo $value['social_media_link'] ?>" target="_blank"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>"></a></li>
                        <?php endforeach ?>
                    </ul>
                    <p><?php echo date('Y') ?> All Rights Reserved.</p>
                </div>
            </div>

        </div>

    </div>

</body>
<?php wp_footer(); ?>
</html>