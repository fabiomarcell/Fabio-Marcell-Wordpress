<?php

get_header(); ?>
<?php
	// Start the loop.
	while ( have_posts() ) { the_post();
?>	

<div class="container" style='margin-top: 100px; margin-bottom: 100px;'>	
<div class="row">
	
	<div class="col-md-12 titulo-item">
		<h2><?=the_title()?></h2>
	</div>


	<div class="col-md-6">
			<div class='item-individual'>

	
		<?php 
		 	echo get_the_post_thumbnail ( $post->ID, '', array(
                                                        'class' => "img-responsive por-img",
                                                        'desc' => trim( strip_tags( $post->post_title ) )
                                                       
                                                      ));
		?>

		</div>

</div>

	<div class="col-md-6">

	<div class='page-content item-detalhes' id='sobre'>

        <p>
        	<?php
				//echo "<h1>".the_title()."</h1>";
				the_content();
			?>
			<p>
				<?php 
                    $argsOrcamento = array(
	                      'posts_per_page'   => -1,
	                      'orderby'          => 'date',
	                      'order'            => 'ASC',
	                      'post_type'        => 'orcamento',
	                      'post_status'      => 'publish',
	                      'meta_query' => array(
	                      'relation' => 'AND',
	                        array(
	                          'key' => 'orcamento_status',
	                          'value' => '0',
	                        ),
	                        array(
	                          'key' => 'orcamento_ip',
	                          'value' => $_SERVER['REMOTE_ADDR'],
	                        ),
	                        array(
	                          'key' => 'orcamento_produto',
	                          'value' => get_the_ID(),
	                        ),
	                      ) 
	                    );
	                    $mypostsOrcamento = get_posts($argsOrcamento);
	                    if(count($mypostsOrcamento) > 0){
							echo '<button class="btn btn-orcamento" type="button"><i class="fa fa-minus-circle"></i> Produto Inserido no Orçamento </button> </p>';
	                    }
	                    else{ 
                    ?>
			                <form id="enviaOrcamento" method="POST" action="<?=get_permalink(39)?>" onsubmit="setOrcamento('enviaOrcamento'); return false;">
								
								<div class="col-md-3 col-md-offset-1">
											<label for="">Quantidade</label>
											<input type="number" name="quantidade" id="quantidade" min="1" value="1" class='form-control'>
								</div>
								<div class="col-md-6"><button class="btn btn-orcamento btn-lg" type="submit" style="margin-top: 15px;"><i class="fa fa-plus-circle"></i> Solicite seu orçamento</button>	</div>
								
								<input type="hidden" name="item" id="item" value="<?=get_the_ID()?>">
								<input type="hidden" name="action" id="action" value="addOrcamento">
							</form>
					<?php 
						}
					?>
			</p>

		</p><!-- .site-main -->

</div><!-- .content-area -->
</div>
</div>
</div>

<?php
	}
?>

<?php get_footer(); ?>
