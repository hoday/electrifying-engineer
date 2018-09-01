<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
    return;
?>

<?php
/**
 * If the current post has comments closed and there are no old comments,
 * there is nothing to show, so just exist
 */
if (!comments_open() && get_comments_number() == 0)
    return;
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">

            <?php
                printf( _nx( 'One reply to "%2$s"', '%1$s replies to "%2$s"', get_comments_number(), 'comments title', 'electrifying-engineer' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>

        </h2>

        <ol class="comment-list">

            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 32,
                ) );
            ?>

        </ol><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>

        <nav class="navigation comment-navigation" role="navigation">
            <div class="nav-previous"><?php previous_comments_link(esc_html__( '&larr; Older Comments', 'electrifying-engineer' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link(esc_html__( 'Newer Comments &rarr;', 'electrifying-engineer' ) ); ?></div>
        </nav><!-- .comment-navigation -->

        <?php endif; // Check for comment navigation ?>



    <?php endif; // have_comments() ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>

    <p class="no-comments"><?php esc_html_e( 'Comments are disabled.' , 'electrifying-engineer' ); ?></p>

    <?php endif; ?>

    <?php if (comments_open() && get_comments_number() == 0) : ?>

    <p class="no-comments"><?php esc_html_e( 'No comments yet.' , 'electrifying-engineer' ); ?></p>

    <?php endif; ?>


    <?php if (comments_open()) :  ?>

    <div class="comment-form">

        <?php comment_form(); ?>

    </div>

    <?php endif; ?>

</div><!-- #comments -->
