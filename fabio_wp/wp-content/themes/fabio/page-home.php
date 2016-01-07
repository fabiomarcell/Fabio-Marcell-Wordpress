<?php
  /*
  Template Name: Home Page
 */
  get_header(); 
?>
          <div id="resultsAllProdutos">
            <div class="row">
              <?php 
                        $args = array(
                            'posts_per_page'   => -1,
                            'orderby'          => 'date',
                            'order'            => 'ASC',
                            'post_type'        => 'produto',
                            'post_status'      => 'publish'
                        );
                        $myposts = get_posts($args);
                        $x = 1;
                        foreach ($myposts as $post) {  setup_postdata( $post );
                          
              ?>
                        
                        <div class="col-lg-3">
                          <img class="img-circle" src="http://www.clker.com/cliparts/f/Z/G/4/h/Q/no-image-available-md.png" width="140" height="140">
                          <h2><?=the_title()?></h2>
                          <p><?=the_content()?></p>
                          <p><a class="btn btn-default" href="<?=get_the_permalink(get_the_id())?>" role="button">Ver Mais »</a></p>
                        </div>
              <?php 
                        if($x == 4){
                          echo '</div>
                                <br>
                                <div class="row">';
                          $x = 0;        
                        }
                        $x++;
                      }

              ?>
            </div>
          </div>
<?php
  get_footer();
?>
