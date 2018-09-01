<?php get_header(''); ?>

    <div class="single-php" style="display: none;"></div>

    <div id="content" class="posts">

        <?php while (have_posts()) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php if (has_post_thumbnail()) : ?>

                <div class="thumbnail">

                    <?php the_post_thumbnail(); ?>

                </div>

                <?php endif; ?>

                <?php if (get_the_title() != '') : ?>

                <h1 class="title">

                    <?php the_title(); ?>

                </h1>

                <?php endif; ?>

                <div class="postauthor">

                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">

                        <?php the_author(); ?>

                    </a>

                </div>

                <div class="postdate">

                    <?php the_time(get_option('date_format')); ?>

                </div>

                <div class="content">

                    <?php the_content(); ?>

                </div>

                <div>

                    <?php wp_link_pages(); ?>

                </div>

                <div class="post-edit-link-wrapper">

                    <?php edit_post_link(); ?>

                </div>

                <div class="tags">

                    <?php the_tags(); ?>

                </div>

                <div class="categories">

                    <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo 'Categories: ';
                            foreach ($categories as $category) {
                                echo '<a href="' . esc_url( get_category_link($category->term_id)) . '">' . esc_html( $category->name ) . '</a>' . '   ';
                            }
                        }
                     ?>

                </div>

                <div class="posts-nav-links">

                    <span class="alignleft">
                    <?php previous_post_link(); ?>
                    </span>
                    <span class="alignright">
                    <?php next_post_link(); ?>
                    </span>

                </div>

                <div>

                    <?php comments_template();  ?>

                </div>

            </div>

        <?php endwhile; ?>

        <aside class="sidebar">

            <?php get_sidebar(); ?>

        </aside>


    </div>

<?php get_footer(); ?>
