<?php
 /*Template Name: Albums
 */
 
get_header(); ?>

<style>
.jks-musicontent{line-height: atuo;}.jks-ptitle{font-size: 20px; line-height: 1.5 em; color:white;}	.jks-title {line-height:auto; color:white;}	.jks-musiclink{}

.jks-musicbackground{	background-image: url("http://localhost/tsiyon-tabernacle.com/wp-content/uploads/2016/12/music-note-bg.jpg");
	background-attachment: fixed;	background-position: center;	background-repeat: no-repeat;	background-size: cover;}

.jks-musicdiscliamer{	text-align:center;	width:100%;	padding:20px 0px 10px 0px;
	background: rgba(24, 77, 129, 0.6);	box-shadow: 0 4px 5px #888888;
}

.jks-disclaimerh1{	color:#73A8E3;}

.jks-row{margin:20px;}

.jks-musicontent {   text-align:center; overflow:wrap;}

	.jks-row {    display: flex; /* equal height of the children */ flex-wrap: wrap; border:solid red 1px;}

	.album-col {    flex: .5; /* additionally, equal width */    max-width:30%; min-width:30%;   padding: 1.5%;}
	
	.jks-albumbackgrounds{height:100%; margin:1.5%; background-image: url(""); border:solid white 2px; border-style: ridge;}
	
	.jks-musicontent{ width:80%; margin-left:10%; padding-top:10% }
  
  
	.jks-albumcovers {text-align:center; min-width:250px; min-height:250px;}
	
	.jks-albumcover { width:80%; height:80%; margin-left:10%; margin-right:10%; padding-top:10%}

@media (max-width:900px){
	.jks-albumcovers{    width:250px;    float:left;  }

	.album-col {    width:100%;    min-height:250px;  }
	
	.jks-albumcover { width:100%; height:auto; margin-left:10%; margin-right:10%;}
} 

@media (max-width:700px){
	.col{    padding-bottom:80px;  }

	.jks-albumcovers{    float:none;    width:60%; margin:12%;}
	
	.jks-albumcover { width:100%; height:auto; }
}
</style>

    <?php
    $mypost = array( 'post_type' => 'tsiyon_albums', );
    $loop = new WP_Query( $mypost );
    ?>
<div class="jks-musicbackground">
<div class="jks-row">
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
</div> <!-- album-row -->
</div> <!-- jks-musicbackground -->
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>