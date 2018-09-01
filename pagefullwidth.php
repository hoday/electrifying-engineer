<?php
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_header(''); ?>

    <div class="pagefullwidth-php" style="display: none;"></div>

    <div id="content" class="posts page-fullwidth">

        <?php while (have_posts()) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php if (has_post_thumbnail()) : ?>

                <div class="thumbnail">

                    <?php the_post_thumbnail(); ?>

                </div>

                <?php endif; ?>

                <?php error_log('here1'); ?>

                <?php if (get_the_title() != '') : ?>
                    <?php error_log('here2'); ?>

                <h1 class="title">

                    <?php the_title(); ?>

                </h1>

                <?php endif; ?>

                <div class="content">
                    
                    <?php error_log('here3'); ?>
                    <?php the_content(); ?>
                    <?php error_log('here4'); ?>

                </div>

                <div>

                    <?php wp_link_pages(); ?>

                </div>

                <div class="post-edit-link-wrapper">

                    <?php edit_post_link(); ?>

                </div>

                <div>

                    <?php comments_template();  ?>

                </div>

            </div>

        <?php endwhile; ?>

    </div>


<?php get_footer(); ?>
