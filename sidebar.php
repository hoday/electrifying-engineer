<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">

        <ul class="widgets-list">

		          <?php dynamic_sidebar( 'sidebar-1' ); ?>

        </ul>

	</div><!-- #primary-sidebar -->
<?php endif; ?>
