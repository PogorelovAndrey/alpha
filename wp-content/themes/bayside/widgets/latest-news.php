<?php
add_action('widgets_init', 'lat_pop_load_widgets');

function lat_pop_load_widgets()
{
	register_widget('Lat_Pop_Widget');
}

class Lat_Pop_Widget extends WP_Widget {
	
	function Lat_Pop_Widget()
	{
		$widget_ops = array('classname' => 'lat-pop', 'description' => 'Latest & Featured Posts.');

		$control_ops = array('id_base' => 'lat-pop-widget');

		$this->WP_Widget('lat-pop-widget', 'Progression: Latest & Featured', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		
		$firsttitle = $instance['firsttitle'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		
		$secondtitle = $instance['secondtitle'];
		$categories_2 = $instance['categories_2'];
		$posts_2 = $instance['posts_2'];

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
			
			
		
		<!-- the tabs -->
		<div class="progression-tab-container">
			<ul class="progression-etabs">
				<li class="progression-tab"><a href="#recent" class="recent-title"><?php echo $firsttitle; ?></a></li>
				<li class="progression-tab"><a href="#popular" class="popular-title"><?php echo $secondtitle; ?></a></li>
			</ul>
		<!-- tab "panes" -->
			<div id="recent">
				<ul class="recent-posts">
					<?php
					$recent_posts = new WP_Query(array(
						'cat' => $categories,
						'showposts' => $posts,
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => 'featured',
								'operator' => 'NOT IN'
							)
						)
					));
					while($recent_posts->have_posts()): $recent_posts->the_post();
					?>
					<li><a href="<?php the_permalink(); ?>">
						<?php if(has_post_thumbnail()): ?><div class="recent-post-image"><?php the_post_thumbnail('progression-sidebar'); ?></div><?php endif; ?>
						<h6><?php the_title(); ?></h6>
						<div class="time-stamp-sidebar"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php _e('ago','progression'); ?></div>
					</a></li>
					<?php endwhile; ?>
				</ul>
			</div>
			<div id="popular">
				<ul class="recent-posts">
					<?php
					$recent_posts = new WP_Query(array(
						'cat' => $categories_2,
						'showposts' => $posts_2,
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => 'featured',
								'operator' => 'NOT IN'
							)
						)
					));
					while($recent_posts->have_posts()): $recent_posts->the_post();
					?>
					<li><a href="<?php the_permalink(); ?>">
						<?php if(has_post_thumbnail()): ?><div class="recent-post-image"><?php the_post_thumbnail('progression-sidebar'); ?></div><?php endif; ?>
						<h6><?php the_title(); ?></h6>
						<div class="time-stamp-sidebar"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?> <?php _e('ago','progression'); ?></div>
					</a></li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
		
		
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		
		
		$instance['firsttitle'] = $new_instance['firsttitle'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		
		$instance['secondtitle'] = $new_instance['secondtitle'];
		$instance['categories_2'] = $new_instance['categories_2'];
		$instance['posts_2'] = $new_instance['posts_2'];
		
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'firsttitle' => 'Recent', 'secondtitle' => 'Featured', 'categories' => 'all', 'posts' => 3, 'categories_2' => 'all', 'posts_2' => 3);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		
		<h3 style='margin-top: 40px;'>Tab 1</h3>
		<p>
			<label for="<?php echo $this->get_field_id('firsttitle'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('firsttitle'); ?>" name="<?php echo $this->get_field_name('firsttitle'); ?>" value="<?php echo $instance['firsttitle']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		
		<h3 style='margin-top: 40px;'>Tab 2</h3>
		
		<p>
			<label for="<?php echo $this->get_field_id('secondtitle'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('secondtitle'); ?>" name="<?php echo $this->get_field_name('secondtitle'); ?>" value="<?php echo $instance['secondtitle']; ?>" />
		</p>
		

		<p>
			<label for="<?php echo $this->get_field_id('categories_2'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories_2'); ?>" name="<?php echo $this->get_field_name('categories_2'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories_2']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories_2']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_2'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts_2'); ?>" name="<?php echo $this->get_field_name('posts_2'); ?>" value="<?php echo $instance['posts_2']; ?>" />
		</p>
		
	<?php
	}
}
?>