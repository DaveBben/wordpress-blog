<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

//http://www.thomashardy.me.uk/wordpress-word-count-function
// https://gist.github.com/mynameispj/3170442
function read_time(){
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    $m = floor($word_count / 200);
    $s = floor($word % 200 / (200 / 60));
	if ($m <= 0){
		 $est = 'less than one minute read';
	}
	else{
    $est = $m . ' minute read';
	}
    return $est;
   
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
    return '';
}

add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/**
 * Find the last period in the excerpt and remove everything after it.
 * If no period is found, just return the entire excerpt.
 *
 * @param string $excerpt The post excerpt.
 * https://wordpress.stackexchange.com/questions/241828/end-excerpt-at-the-end-of-the-sentence
 */
function end_with_sentence( $excerpt ) {
	if ( ( $pos = mb_strrpos( $excerpt, '.' ) ) !== false ) {
	  $excerpt = substr( $excerpt, 0, $pos + 1 );
	}
  
	return $excerpt;
  }
  add_filter( 'the_excerpt', 'end_with_sentence' );

  // Meta Box
add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add() {
    add_meta_box( 'my-meta-box-id', 'YouTube Embed ID', 'cd_meta_box_cb', 'post', 'side', 'default' );
}
function cd_meta_box_cb( $post )
{
$values = get_post_custom( $post->ID );
$text = isset( $values['my_meta_box_text'] ) ? esc_attr( $values['my_meta_box_text'][0] ) : '';
wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
<p>
    <label for="my_meta_box_text">YouTube ID</label>
    <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php echo $text; ?>" />
        </p>
    <?php        
}
add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id ) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );
    // Probably a good idea to make sure your data is set
    if( isset( $_POST['my_meta_box_text'] ) )
        update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
}?>
