<?php
/*
 * This is the code that is run with the shortcode [display-album]
 */


function album_loop(){
    ?><style><?php include 'loop-styles.css'; ?></</style><?php
        $mypost = array( 'post_type' => 'tsiyon_albums', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '3', 'paged' => $paged );
        $loop = new WP_Query( $mypost );
        ?>
    <div class="jks-musicbackground">
    <div class="jks-row">

        <p><?php posts_nav_link( ' or ', 'You can go back to the previous page', 'you can go forward to the next page' ); ?>.</p>

        <?php while ( $loop->have_posts() ) : $loop->the_post();?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">

                    <div class="col">
                        <div class="jks-albumbackgrounds">
                        <div class="jks-albumcovers">
                            <?php the_post_thumbnail('thumbnail', array('class' => 'jks-albumcover')); ?>
                        </div><!-- jks-albumcovers -->

                        <div class="jks-musicontent">
                            <h1 class="jks-title">Album: <em><?php the_title(); ?></em></h1>
                            <h2 class="jks-title">Artist: <em><?php echo esc_html( get_post_meta( get_the_ID(), 'artist_name', true ) ); ?></em></h2>
                            <h2 class="jks-title">Find the Music: <em><a href="<?php echo $artist_website; ?>"><?php echo $artist_website_html; ?></a></em></h2>
                        </div><!-- jks-musicontent -->
                        </div><!--jks-albumbackgrounds -->
                    </div><!-- col -->

                </header>
            </article>
        <?php endwhile; ?>
        <style>
            .navigation { list-style:none; font-size:12px; }
            .navigation li{ display:inline; }
            .navigation li a{ display:block; float:left; padding:4px 9px; margin-right:7px; border:1px solid #efefef; }
            .navigation li span.current { display:block; float:left; padding:4px 9px; margin-right:7px; border:1px solid #efefef; background-color:#f5f5f5;  }	
            .navigation li span.dots { display:block; float:left; padding:4px 9px; margin-right:7px;  }  
        </style>
        <?php
        /* ------------------------------------------------------------------*/
        /* PAGINATION */
        /* ------------------------------------------------------------------*/

        //paste this where the pagination must appear

            global $mypost;
            $total = $mypost->max_num_pages;
            // only bother with the rest if we have more than 1 page!
            if ( $total > 1 )  {
                 // get the current page
                 if ( !$current_page = get_query_var('paged') )
                      $current_page = 1;
                 // structure of "format" depends on whether we're using pretty permalinks
                 if( get_option('permalink_structure') ) {
                         $format = '&paged=%#%';
                 } else {
                         $format = 'page/%#%/';
                 }
                 echo paginate_links(array(
                      'base'     => get_pagenum_link(1) . '%_%',
                      'format'   => $format,
                      'current'  => $current_page,
                      'total'    => $total,
                      'mid_size' => 4,
                      'type'     => 'list'
                 ));
            }
        ?>



    </div> <!-- album-row -->
    </div> <!-- jks-musicbackground -->
    <?php
}

        add_shortcode('display-album', 'album_loop');

?>