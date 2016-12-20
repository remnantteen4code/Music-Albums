<?php
 
add_action('admin_menu' , 'brdesign_enable_pages'); 
 
function brdesign_enable_pages() {
    add_submenu_page('edit.php?post_type=music_albums', 'Album Options', 'Custom Options', 'edit_posts', 'album-adimn-options', 'options_html_content');
}

function options_html_content() {
?>
<hr />
    <h1 align="center">Album Options</h1>
<hr />

<div style="padding-left: 5%;"
     <tr><h2>Background Image</h2></tr>
    <tr valign="top">
        <form method="post">
            <input id="image-url" type="text" name="image" />
            <input id="upload-button" type="button" class="button" value="Upload Image" />

            <input type="submit" value="Submit" />
        </form>
    </tr>
</div>
<?php
  global $wpdb;
  
  if ( !empty( $_POST['image'] ) ) {
    $image_url = $_POST['image'];
    $wpdb->insert( 'images', array( 'image_url' => $image_url ), array( '%s' ) ); 
  }
  
      /* Add the media uploader script */
      function my_media_lib_uploader_enqueue() {
        wp_enqueue_media();
        wp_register_script( 'media-lib-uploader-js', plugins_url( 'media-lib-uploader.js' , __FILE__ ), array('jquery') );
        wp_enqueue_script( 'media-lib-uploader-js' );
      }
      add_action('admin_enqueue_scripts', 'my_media_lib_uploader_enqueue');
}

