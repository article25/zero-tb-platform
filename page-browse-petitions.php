<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="container">
	<div class="row">
		<ul class="list-unstyled">
			<?php
				$args = array('posts_per_page' => 15, 'offset'=> 0, 'order'=> 'ASC', 'orderby' => 'date');
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<li>
				<div class="col-md-2 col-md-offset-1 browse-thumb">
					<a href="<?php the_permalink(); ?>"><?php add_image_size( 'browse_custom', 175, 100, true); the_post_thumbnail( 'browse_custom' ); ?></a>
				</div>
				<div class="col-md-8 browse-text-blk">
				<a id="browse-post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<h6 class="browse-target">To:  <?php $value_0 = get_post_custom_values("field_target_petition"); echo $value_0[0]; echo ' '; ?>
				<h6 class="peti-thumb-author"><span class="glyphicon glyphicon-user"></span> <?php $value_1 = get_post_custom_values("field_petition_sigs"); echo $value_1[0]; echo ' supporters'; ?> | By:  <?php $value_2 = get_post_custom_values("field_first_name_petition"); $value_3 = get_post_custom_values("field_last_name_petition"); echo $value_2[0]; echo ' '; echo $value_3[0]; ?></h6>
				<p><?php the_excerpt(); ?></p>
			</div>
			</li>
			<?php endforeach; 
				wp_reset_postdata();?>
		</ul>
	</div>
</div>
<?php endwhile; endif; ?>
</section>
<?php get_footer(); ?>