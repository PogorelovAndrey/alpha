<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package progression
 * @since progression 1.0
 */
?>

<div id="sidebar">
	<div class="sidebar-icon"><a href="#" class="sidebar-icon-link"></a></div>
	
	<?php get_search_form(); ?>
	
	<div id="sidebar-widgets">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
		
		<footer>
			<div id="copyright">
				<?php echo of_get_option('copyright_textarea', '&copy; 2012 All Rights Reserved.<br>
				 Developed by <a href="http://themeforest.net/user/ProgressionStudios/?ref=ProgressionStudios" target="_blank">Progression Studios</a>.'); ?>
			</div><!-- close #copyright -->
		</footer>
		
	</div><!-- close #sidebar-widgets-->
</div><!-- close #sidebar -->
