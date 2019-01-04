<?php /* Template Name: PageWithoutSidebar */ ?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php 
/*
    $post_title = 'Test Movie by Jahid';
    $post_category = 88;
    $post_content = 'The content';

    $new_post = array(
          'ID' => '',
          'post_author' => 1, 
          'post_type' => 'movie',
          'post_category' => array($post_category),
          'post_content' => $post_content, 
          'post_title' => $post_title,
          'post_status' => 'publish'
        );

    $post_id = wp_insert_post($new_post);
*/



/*
$id = array(
        'ID' => 1791,
        'post_title'    => 'My Title',
        'post_content'  => 'My Content',
        'post_date'     => date('Y-m-d H:i:s'),
        'post_author'   => 1,
        'post_type'     => 'movie',
        'post_status'   => 'publish',
    ); 
     $user_id = wp_insert_post($id);
     wp_set_object_terms($user_id, 51, 'movie_cat', true);
    if ( ! is_wp_error( $user_id ) ) {
       $odgovor["success"] = 1;

    }
*/

function _uploadImageToMediaLibrary($postID, $url, $alt = "blabla") {

   // require_once("../sites/$this->_wpFolder/wp-load.php");
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $tmp = download_url( $url );
    $desc = $alt;
    $file_array = array();

    // Set variables for storage
    // fix file filename for query strings
    preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
    $file_array['name'] = basename($matches[0]);
    $file_array['tmp_name'] = $tmp;

    // If error storing temporarily, unlink
    if ( is_wp_error( $tmp ) ) {
        @unlink($file_array['tmp_name']);
        $file_array['tmp_name'] = '';
    }

    // do the validation and storage stuff
    $id = media_handle_sideload( $file_array, $postID, $desc);

    // If error storing permanently, unlink
    if ( is_wp_error($id) ) {
        @unlink($file_array['tmp_name']);
        return $id;
    }

    return $id;
}




$attach_id_list = '1747,1738';

$attach_id = _uploadImageToMediaLibrary(12,'https://m.media-amazon.com/images/M/MV5BMTg3MDA0NDQ3OV5BMl5BanBnXkFtZTgwMTg2NTAwMjI@._V1_SY1000_CR0,0,1348,1000_AL_.jpg');

    wp_insert_post(array('post_title' => 'some title', 'post_author' => 1, 'post_type' => 'movie', 'post_status' => 'publish', 'meta_input' => array( 'shift8_portfolio_posters_gallery' => $attach_id_list, 'themeum_movie_image_cover' => 1758,  'themeum_movie_actor' => array('phillip-guzman','richard-lukens')),'tax_input' => array( 'movie_cat' => 51)));


 ?>



<?php get_footer();
