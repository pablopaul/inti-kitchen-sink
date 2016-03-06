<?php 

/**
 * Add a shortcode for displaying a list of testimonials
 */
function inti_shortcode_testimonials( $atts, $content = null ) {	
	$content = trim($content);	
	extract( shortcode_atts( array(
		'catid' => '',
		'align' => '',
		'order' => ''
	), $atts));

		if ($order != "ASC" || $order != "DESC") { $order = "ASC"; }

		if (!empty($catid)) {
			$args = array(
				'post_type' => 'inti-testimonial',
				'orderby' => 'menu_order',
				'order' => $order,
				'posts_per_page' => 100,
				'tax_query' => array(array('taxonomy' => 'inti-testimonial-category', 'field' => 'id', 'terms' => $catid)),
			);
			$testimonials = new WP_Query($args);
			//$testimonials = new WP_Query('post_type=inti-testimonial&orderby=menu_order&order=ASC&posts_per_page=100&cat=' . $catid);
		} else {
			$args = array(
				'post_type' => 'inti-testimonial',
				'orderby' => 'menu_order',
				'order' => $order,
				'posts_per_page' => 100,
				//'tax_query' => array(array('taxonomy' => 'inti-testimonial-category', 'field' => 'id', 'terms' => $catid)),
			);
			$testimonials = new WP_Query($args);
			//$testimonials = new WP_Query('post_type=inti-testimonial&orderby=menu_order&order=ASC&posts_per_page=100'); 
		}

		ob_start();
		$right = false;
		while($testimonials->have_posts()) : $testimonials->the_post();
			$has_image = has_post_thumbnail(get_the_ID()); ?>

			<?php if ($align == "left" || $align == "") : ?>

				<blockquote class="testimonial left">
					<?php if ($has_image) : ?>
						<div class="row">
							<div class="medium-5 mlarge-4 columns">
								<div class="testimonial-image">
									<?php the_post_thumbnail('testimonial-thumbnail'); ?>
								</div>
							</div>
							<div class="medium-7 mlarge-8 columns">
								<div class="testimonial-text">
									<?php the_content(); ?>
									<cite class="testimonial-owner">
										<?php the_testimonial_owner($testimonials->ID); ?>
									</cite>
								</div>
							</div>
						</div>
					<?php else : ?>
						<div class="row">
							<div class="column">
								<div class="testimonial-text">
									<?php the_content(); ?>
									<cite class="testimonial-owner">
										<?php the_testimonial_owner($testimonials->ID); ?>
									</cite>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</blockquote>



			<?php elseif ($align == "right") : ?>

				<blockquote class="testimonial right">
					<?php if ($has_image) : ?>
						<div class="row">
							<div class="medium-5 medium-push-7 mlarge-4 mlarge-push-8 columns">
								<div class="testimonial-image">
									<?php the_post_thumbnail('testimonial-thumbnail'); ?>
								</div>
							</div>
							<div class="medium-7 medium-pull-5 mlarge-8 mlarge-pull-4 columns">
								<div class="testimonial-text">
									<?php the_content(); ?>
									<cite class="testimonial-owner">
										<?php the_testimonial_owner($testimonials->ID); ?>
									</cite>
								</div>
							</div>
						</div>
					<?php else : ?>
						<div class="row">
							<div class="column">
								<div class="testimonial-text">
									<?php the_content(); ?>
									<cite class="testimonial-owner">
										<?php the_testimonial_owner($testimonials->ID); ?>
									</cite>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</blockquote>



			<?php elseif ($align == "mixed") : ?>
					<?php if ($right) : ?>
						<blockquote class="testimonial mixed right">
							<?php if ($has_image) : ?>
								<div class="row">
									<div class="medium-5 medium-push-7 mlarge-4 mlarge-push-8 columns">
										<div class="testimonial-image">
											<?php the_post_thumbnail('testimonial-thumbnail'); ?>
										</div>
									</div>
									<div class="medium-7 medium-pull-5 mlarge-8 mlarge-pull-4 columns">
										<div class="testimonial-text">
											<?php the_content(); ?>
											<cite class="testimonial-owner">
												<?php the_testimonial_owner($testimonials->ID); ?>
											</cite>
										</div>
									</div>
								</div>
							<?php else : ?>
								<div class="row">
									<div class="column">
										<div class="testimonial-text">
											<?php the_content(); ?>
											<cite class="testimonial-owner">
												<?php the_testimonial_owner($testimonials->ID); ?>
											</cite>
										</div>
									</div>
								</div>
							<?php endif; ?>

					<?php $right = false; else : ?>
						<blockquote class="testimonial mixed left">
						<?php if ($has_image) : ?>
							<div class="row">
								<div class="medium-5 mlarge-4 columns">
									<div class="testimonial-image">
										<?php the_post_thumbnail('testimonial-thumbnail'); ?>
									</div>
								</div>
								<div class="medium-7 mlarge-8 columns">
									<div class="testimonial-text">
										<?php the_content(); ?>
										<cite class="testimonial-owner">
											<?php the_testimonial_owner($testimonials->ID); ?>
										</cite>
									</div>
								</div>
							</div>
						<?php else : ?>
							<div class="row">
								<div class="column">
									<div class="testimonial-text">
										<?php the_content(); ?>
										<cite class="testimonial-owner">
											<?php the_testimonial_owner($testimonials->ID); ?>
										</cite>
									</div>
								</div>
							</div>
						<?php endif; ?>

					<?php $right = true; endif; ?>
				</blockquote>



			<?php elseif ($align == "vertical") : ?>

				<blockquote class="testimonial vertical">
					<?php if ($has_image) : ?>
						<div class="row">
							<div class="column">
								<div class="testimonial-image">
									<?php the_post_thumbnail('testimonial-thumbnail'); ?>
								</div>
							</div>
							<div class="column">
								<div class="testimonial-text">
									<?php the_content(); ?>
									<cite class="testimonial-owner">
										<?php the_testimonial_owner($testimonials->ID); ?>
									</cite>
								</div>
							</div>
						</div>
					<?php else : ?>
						<div class="row">
							<div class="column">
								<div class="testimonial-text">
									<?php the_content(); ?>
									<cite class="testimonial-owner">
										<?php the_testimonial_owner($testimonials->ID); ?>
									</cite>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</blockquote>



			<?php else : ?>
				<div class="callout alert">
					<p><?php _e('Alignment not recognized', 'inti'); ?></p>
				</div>
			<?php endif; ?>

			

		
		<?php
		endwhile;
		$html = '<section class="testimonials-list">';
		$html .= ob_get_contents();
		$html .= '</section>';
		ob_end_clean();

		return $html;
}
add_shortcode('testimonials', 'inti_shortcode_testimonials');



/**
 * Add a filter so it shows in the shortcode picker
 */
function inti_shortcode_add_testimonials_to_select($args){
	$args['inti-testimonials'] = 'Testimonials';
	return $args;
}
add_filter( 'inti_shortcode_filter_select' , 'inti_shortcode_add_testimonials_to_select');


/**
 * Enqueue JS
 */
function child_shortcode_enqueue_testimonials_shortcodes($hook){
	if ($hook == "post.php"){

		wp_register_script('inti-testimonials', get_stylesheet_directory_uri() . '/framework/shortcodes/js/shortcode-testimonials.js', '', filemtime(get_stylesheet_directory() . '/framework/shortcodes/js/shortcode-testimonials.js'), TRUE);
		wp_enqueue_script('inti-testimonials'); 
	}
}
add_action('admin_enqueue_scripts', 'child_shortcode_enqueue_testimonials_shortcodes');

/**
 * Dispaly for inti-testimonials
 */
function inti_shortcode_add_testimonials() {
	ob_start();?>
	<tr class="option inti-testimonials">
		<th class="label">
			<label for="testimonials-id"><?php _e('Choose a Testimonials Category', 'inti'); ?></label>
		</th>

		<td class="field">
			<?php wp_dropdown_categories(array(
				'show_option_all'    => '&mdash; ' . __("All Categories", 'inti') . ' &mdash;',
				'show_count' => true,
				'taxonomy' => 'inti-testimonial-category',
				'name' => 'testimonials-catid',
				'id' => 'testimonials-catid',
				'class' => 'widefat'
			 )); ?>
		</td>
	</tr>
	<tr class="option inti-testimonials">
		<th class="label">
			<label for="testimonials-align"><?php _e('Photo Align', 'inti'); ?></label>
		</th>

		<td class="field">
		
			<select name="testimonials-align" id="testimonials-align" class="widefat">
				<option value="left" selected><?php _e('All Left', 'inti'); ?></option>
				<option value="right"><?php _e('All Right', 'inti'); ?></option>
				<option value="mixed"><?php _e('Left Right Left', 'inti'); ?></option>
				<option value="vertical"><?php _e('Photo above', 'inti'); ?></option>
			</select>

		</td>
	</tr>	

	<tr class="option inti-testimonials">
		<th class="label">
			<label for="testimonials-order"><?php _e('Order', 'inti'); ?></label>
		</th>

		<td class="field">
		
			<select name="testimonials-order" id="testimonials-order" class="widefat">
				<option value="ASC" selected><?php _e('Ascending', 'inti'); ?></option>
				<option value="DESC"><?php _e('Descending', 'inti'); ?></option>
			</select>

		</td>
	</tr>
	

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_testimonials', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_testimonials');