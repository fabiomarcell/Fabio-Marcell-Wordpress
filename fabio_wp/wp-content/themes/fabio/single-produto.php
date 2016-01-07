<?php
  /*
  Template Name: single produto
 */

  get_header(); 
?>

          <div class="row" id="result">
          <?php
            while ( have_posts() ){ the_post();
          ?>
            
            <div class="col-lg-6">
              <img id="imgproduto" class="img-circle" src="http://www.clker.com/cliparts/f/Z/G/4/h/Q/no-image-available-md.png" width="340" height="340">
              <h2 id="produto"><?=the_title()?></h2>
            </div>
            <?php ini_set('display_errors', 1); ?>
            <div class="col-lg-6">
              <p id="descricao"><?=the_content()?></p>
              <h2 id="valor">R$ <?=rwmb_meta('produto_valor', null, get_the_id())?></h2>
              <p><a class="btn btn-default" href="<?=get_the_permalink(12)?><?=$post->post_name;?>" role="button" id="link">Encomendar »</a></p>
            </div>

          <?php
            }
          ?>
          
          </div>
          

<?php
  get_footer();
?>
