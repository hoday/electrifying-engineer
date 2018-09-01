<?php get_header(''); ?>

    <div class="index-php" style="display: none;"></div>

    <div id="content" class="posts">

        <?php while (have_posts()) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php if (has_post_thumbnail()) : ?>

                <div class="thumbnail">

                    <a href="<?php the_permalink(); ?>">

                        <?php the_post_thumbnail(); ?>

                    </a>

                </div>

                <?php endif; ?>

                <?php if (get_the_title() != '') : ?>

                <h1 class="title">

                    <a href="<?php the_permalink(); ?>">

                        <?php the_title(); ?>

                    </a>

                </h1>

                <?php endif; ?>

                <div class="postdate">

                    <a href="<?php the_permalink(); ?>">

                        <?php the_time(get_option('date_format')); ?>

                    </a>

                </div>

                <div class="content">

                    <?php the_content(); ?>

                </div>

                <div class="post-edit-link-wrapper">

                    <?php edit_post_link(); ?>

                </div>

            </div>

        <?php endwhile; ?>

        <div class="posts-nav-links">

            <?php echo paginate_links(array()); ?>

        </div>

        <aside class="sidebar">

            <?php get_sidebar(); ?>

        </aside>

    </div>


<?php get_footer(); ?>
