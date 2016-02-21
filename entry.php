<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header>


<?php $value_0 = get_post_custom_values("field_target_petition"); echo '<div class="column"><div class="row"><div class="col-md-12 text-center pet_target"><h4>Petition to: '; echo $value_0[0]; echo '</h4></div></div></div>'; ?>

<?php if ( is_singular() ) { echo '<div class="container"><div class="row"><div class="col-md-12 text-center"><h1 class="entry-title">'; } else { echo '<h2 class="entry-title">'; } ?><title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?><?php if ( is_singular() ) { echo '</h1></div></div></div>'; } else { echo '</h2>'; } ?> 
</header>

<?php $value_1 = get_post_custom_values("field_first_name_petition"); $value_2 = get_post_custom_values("field_last_name_petition"); echo '<div class="column"><div class="row"><div class="col-md-12 text-center"><h5>Petition by: '; echo $value_1[0]; echo ' '; echo $value_2[0]; echo '</h5></div></div></div>'; ?>



<?php get_template_part( 'entry', ( is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
<?php if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
</article>