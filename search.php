<?php get_header(''); ?>

    <div class="search-php" style="display: none;"></div>

    <div id="content" class="posts">

        <?php $searchTerm = get_search_query(); ?>
        <?php $searchTerm = '<strong>' . $searchTerm . '</strong>'; ?>
        <?php $postCount = $wp_query->post_count; ?>


        <div class="searchheader">

            <div>

                <?php get_search_form(); ?>

            </div>

            <?php if (have_posts()) :?>

                <p>
                    <?php
                        printf(_nx('1 result found for: "%2$s"', '%1$s results found for: "%2$s"', $postCount, 'search results title', 'electrifying-engineer' ),
                            number_format_i18n($postCount), '<span>' . $searchTerm . '</span>' );
                    ?>

                </p>

            <?php else: ?>

                <p><?php printf(esc_html__('No results found for: %s', 'electrifying-engineer'), $searchTerm); ?></p>

            <?php endif; ?>

        </div>


        <?php while (have_posts()) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class('searchresult'); ?>>

                <?php if (get_the_title() != '') : ?>

                <h1 class="title">

                    <?php the_title(); ?>

                </h1>

                <?php endif; ?>

                <div class="content">

                    <?php the_content(); ?>

                    <?php edit_post_link(null,'<div class="post-edit-link-wrapper">', '</div>'); ?>

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
