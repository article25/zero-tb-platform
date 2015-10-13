<?php
add_action( 'gform_after_submission_1', 'set_post_content', 10, 2 );
function set_post_content( $entry, $form ) {

    //getting post
    $post = get_post( $entry['post_id'] );

    //setting grid variables
    $petition_form_contain = '"container"';
    $petition_form_row = '"row"';

    $petition_form_col_1 = '"col-md-1"';
    $petition_form_col_4_off_1 = '"col-md-4 col-md-offset-1"';
    $petition_form_col_5 = '"col-md-5"';
    $petition_form_col_6_off_1 = '"col-md-6 col-md-offset-1"';

    //other variables
    $petition_form = '"petition-privacy"';
    $petition_form_petf = '"petfsize"';
    $quoteone = '"';

    //setting up the petition form
    $formid = 1;
    $form_count = RGFormsModel::get_form_counts($formid);
    $form_count_disp = $form_count['total'];
    $form_id_step = $form_count_disp + 0;

    $form_id = 2;
    $form = GFAPI::get_form($form_id);
    $form_add_new = GFAPI::add_form($form);

    $form_id = $form_id_step;
    $form = GFAPI::get_form( $form_id );
    $form['title'] = 'Petition Form ID'.' '.$form_id;
    $result = GFAPI::update_form($form);

    //changing post content
    $post->post_content = "<div class=$petition_form_col_4_off_1>[gravityform id =$quoteone$form_id_step$quoteone]</div><div class=$petition_form_contain><div class=$petition_form_row>
<div class=$petition_form_col_6_off_1><div class=$petition_form_petf>". rgar( $entry, '4' ) ."</div></div><div class=$petition_form_col_5></div></div></div>";
    //updating post
    wp_update_post( $post );
}

add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

//set image size for thumbnails on index page
add_image_size( 'peti-thumb-size', 350, 160, array( 'center', 'center' ) );

global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;


register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
);
}

add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

