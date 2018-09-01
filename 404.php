<?php get_header(''); ?>

    <div class="404.php"></div>

    <div id="content" class="posts">

        <div class="error404msg">

            <p>

                <?php esc_html_e('Not found', 'electrifying-engineer'); ?>

            </p>
            <p>

                <?php esc_html_e('Couldn\'t find what you were looking for?', 'electrifying-engineer'); ?>

            </p>
            <p>

                <?php esc_html_e('Try searching:', 'electrifying-engineer'); ?>
            </p>
            <div class="indent">
                <?php get_search_form(); ?>
            </div>
            <p>
                <?php esc_html_e('or look through recent posts: ', 'electrifying-engineer'); ?>
            </p>
            <div class="indent">
                <h2>
                    <?php esc_html_e('Recent Posts', 'electrifying-engineer'); ?>
                </h2>

                <?php
                    $args = array(
                        'numberposts' => 5,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );

                    $posts = get_posts($args);
                    if (!empty($posts)) {
                ?>
                    <ul>
                <?php

                        foreach ($posts as $post) {
                            ?>

                                <li>

                                    <a href="<?php echo get_permalink($post->ID); ?>">

                                        <?php echo esc_html($post->post_title); ?>

                                    </a>

                                </li>

                            <?php
                        }

                        ?>
                            </ul>
                        <?php

                    }

                ?>
            </div>

        </div>

        <aside class="sidebar">

            <?php get_sidebar(); ?>

        </aside>

    </div>


<?php get_footer(); ?>
