<?php

get_header(); ?>
<?php
	// Start the loop.
	while ( have_posts() ) { the_post();
?>	
	<section style="width:100%;">
		<?php 
		 	echo get_the_post_thumbnail ( $post->ID, '', array(
                                                        'class' => "img-responsive por-img",
                                                        'desc' => trim( strip_tags( $post->post_title ) ),
                                                        'style' => 'width:100%; height:600px;'
                                                      ));
		?>
	</section>
	<section class='page-content' id='sobre'>
       <div class="container">
        <div class="row">
        	<?php
				echo "<h1>".the_title()."</h1>";
				the_content();
				// Previous/next post navigation.
				/*the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'notcake' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'notcake' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'notcake' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'notcake' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );*/
			?>
		</div><!-- .site-main -->
	</div>
</section><!-- .content-area -->
<?php
	}
?>

<?php get_footer(); ?>
