<?php
/*
Plugin Name: Music Albums
Plugin URI: n/a
Description: A plugin that will create a custom post type displaying the Music Albums.
Version: 1.0
Author: Remnant Teen
Author URI: n/a
*/

add_action( 'init', 'create_music_albums' );

function create_music_albums() {
    register_post_type( 'music_albums',
        array(
            'labels' => array(
                'name' => 'Albums',
                'singular_name' => 'Album',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Album',
                'edit' => 'Edit',
                'edit_item' => 'Edit Album',
                'new_item' => 'New Album',
                'view' => 'View',
                'view_item' => 'View Album',
                'search_items' => 'Search Album',
                'not_found' => 'No Albums found',
                'not_found_in_trash' => 'No Albums found in Trash',
                'parent' => 'Parent Album'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/note.png', __FILE__ ),
            'has_archive' => true
        )
    );
    
    include 'menus/options.php';
}


add_action( 'admin_init', 'my_admin' );

    function my_admin() {
        add_meta_box( 'album_meta_box',
            'Album Details',
            'display_album_meta_box',
            'music_albums', 'normal', 'high'
        );
    }

    function display_album_meta_box( $album_info ) {
        // Retrieve current name of the Director and Movie Rating based on review ID
        $album_title = esc_html( get_post_meta( $album_info->ID, 'album_title', true ) );
        $album_rating = intval( get_post_meta( $album_info->ID, 'album_rating', true ) );
        $artist_name = esc_html( get_post_meta( $album_info->ID, 'artist_name', true ) );
        $artist_website = esc_html( get_post_meta( $album_info->ID, 'artist_website', true ) );
        $artist_website_html = esc_html( get_post_meta( $album_info->ID, 'artist_website_html', true ) );
        $find_album = esc_html( get_post_meta( $album_info->ID, 'find_album', true ) );
        ?>
        <table>
            <tr>
                <td style="width: 100%">Album:</td>
                <td><input type="text" size="80" name="album_info_title_name" value="<?php echo $album_title; ?>" /></td>
            </tr>
            <tr>
                <td style="width: 100%">Artist:</td>
                <td><input type="text" size="80" name="artist_name" value="<?php echo $artist_name; ?>"</td>
            </tr>
            <tr>
                <td style="width: 100%">Artists Website HTML</td>
                <td><input type="html" size="80" name="artist_name" <a href="<?php echo $artist_website; ?>"></td>
            </tr>
            <tr>
                <td style="width: 100%">Alternative Contact Info</td>
                <td><input type="text" size="80" name="artist_name" href="<?php echo $artist_website_html; ?>"</td>
            </tr>
            <tr>
                <td style="width: 150px">Album Rating</td>
                <td>
                    <select style="width: 100px" name="album_info_rating">
                    <?php
                    // Generate all items of drop-down list
                    for ( $rating = 5; $rating >= 1; $rating -- ) {
                    ?>
                        <option value="<?php echo $rating; ?>" <?php echo selected( $rating, $album_rating ); ?>>
                        <?php echo $rating; ?> stars <?php } ?>
                    </select>
                </td>
            </tr>
        </table>
        <?php
    }
    
add_action( 'save_post', 'add_album_info_fields', 10, 2 );

    function add_album_review_fields( $album_info_id, $album_info ) {
        // Check post type for movie reviews
        if ( $album_info->post_type == 'music_albums' ) {
            // Store data in post meta table if present in post data
            if ( isset( $_POST['album_info_director_name'] ) && $_POST['album_info_title_name'] != '' ) {
                update_post_meta( $album_info_id, 'album_title', $_POST['album_info_title_name'] );
            }
            if ( isset( $_POST['album_info_rating'] ) && $_POST['album_info_rating'] != '' ) {
                update_post_meta( $album_info_id, 'album_rating', $_POST['album_info_rating'] );
            }
        }
    }
    

add_filter( 'template_include', 'include_template_function', 1 );

    function include_template_function( $template_path ) {
        if ( get_post_type() == 'music_albums' ) {
            if ( is_single() ) {
                // checks if the file exists in the theme first,
                // otherwise serve the file from the plugin
                if ( $theme_file = locate_template( array ( 'single-album.php' ) ) ) {
                    $template_path = $theme_file;
                } else {
                    $template_path = plugin_dir_path( __FILE__ ) . '/single-album.php';
                }
            }
        }
        return $template_path;
    }

    


    
    include 'loops/album-loop.php';


?>

