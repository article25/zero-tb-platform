<section class="entry-content">
<?php 
   //get current max value
   $pet_max_val = get_post_custom_values("field_max_petition");
   $pet_max_val_new = implode(" ", $pet_max_val);

   //get number of signatures
   $pet_form_id_val = get_post_custom_values("field_petition_form_id");
   $formid = implode(" ", $pet_form_id_val);
   $form_count = RGFormsModel::get_form_counts($formid);
   $pet_sigs_val = $form_count['total'];

 //calculate bar percentage fill
   $pet_bar_val = ($pet_sigs_val / $pet_max_val_new)*100;

   //display progress bar 
echo '<div class="container"><div class="row"><div class="col-md-6 col-md-offset-1"><div class="progress"><div class="progress-bar progress-bar-striped" role="progressbar" style="width: '; echo $pet_bar_val; echo '%">'; echo $pet_sigs_val; echo ' supporters </div></div><h5>'; echo $pet_sigs_val; echo ' supporters have signed. Help us get to '; echo $pet_max_val_new; echo '!</h5>'; 

    //update number of sigs 
    $postid = $post->ID;
    $meta_key = 'field_petition_sigs';
    update_post_meta($postid, $meta_key, $pet_sigs_val);

?>

<?php if ( has_post_thumbnail() ) {the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); echo '</div>';} ?>

<?php the_content(); ?>


<?php

   //get Updates Form ID
   $pet_form_id_val = get_post_custom_values("field_petition_form_id");
   $formid_pet = implode(" ", $pet_form_id_val);
   $formid_update = $formid_pet + 1;
   $formid_update_array = explode(" ", $formid_update);

    $my_query = new WP_Query( array( 'post_type' => 'updates', 'meta_key' => 'update_form_id', 'meta_value' => $formid_update_array));
      while ($my_query->have_posts()) : $my_query->the_post(); 
 
echo '<div class="container"><div class="row"><div class="col-md-6 col-md-offset-1"><div class="petfsize">';    
echo '<hr><h4>';
the_title();
echo '</h4>';
    the_content();

echo '</div></div><div class="col-md-5"></div></div></div>';
 endwhile?>




<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>