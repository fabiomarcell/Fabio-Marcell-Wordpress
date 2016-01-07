<?php
  /* Template Name: Page Orcamento*/
  get_header(); 
?>


<style>
  .tbl-orcamento{
      text-align: center;
  }

  .tbl-orcamento th{
      text-align: center!important;
  }

  .tbl-orcamento img{
    width: 80px;
  }
</style>  
    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Orçamento</h2>
                    <h3 class="section-subheading text-muted">Confira os produtos que deseja orçar conosco.</h3>
                </div>
            </div>
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
                          ) 
                        );
                    $myposts = get_posts($argsOrcamento);
                    $x = 1;
                    if(count($myposts) > 0){
                      echo '<div class="col-md-10 col-md-offset-1" id="divOrcamento">'; 
                      echo '<table class="table tbl-orcamento"><thead><tr><th></th><th>Produto</th><th>Quantidade</th><th></th></tr></thead>';
                      foreach ($myposts as $post) {
                        $produtoID = rwmb_meta( 'orcamento_produto', null, $post->ID );

                          echo '<tr class="linha'.$produtoID.'">
                                  <td>
                                    <p>'.get_the_post_thumbnail (  $produtoID, '', array(
                                                                      'class' => "img-responsive por-img",
                                                                      'desc' => trim( strip_tags( $post->post_title ) )
                                                                    )).'
                                    </p>
                                  </td>
                                  <td>
                                    <br>'.
                                    get_the_title($produtoID)
                                  .'</td>
                                  <td>
                                    <div id="valAtual'.$produtoID.'">
                                      <span class="quantidade'.$produtoID.' editar'.$produtoID.'">'.rwmb_meta( 'orcamento_quantidade', null, $post->ID ).'</span>
                                  
                                      <input type="number" id="qtd'.$produtoID.'" value="'.rwmb_meta( 'orcamento_quantidade', null, $post->ID ).'" style="display:none; text-align:center;" class="manutencao'.$produtoID.'">
                                      <br>
                                      <a href="javascript:editarOrcamento('.$produtoID.')" class="editar'.$produtoID.' btn btn-orcamento">Alterar Quantidade</a>
                                      <a href="javascript:salvarOrcamento('.$produtoID.')" style="display:none;" class="manutencao'.$produtoID.' btn btn-orcamento">Salvar Quantidade</a>
                                      <a href="javascript:cancelarOrcamento('.$produtoID.')" style="display:none;" class="manutencao'.$produtoID.' btn btn-orcamento">Cancelar Alteração</a>
                                    </div>  
                                  </td>
                                  <td>
                                    <br>
                                    <a href="javascript:removerOrcamento('.$produtoID.')" class="btn btn-orcamento"><span>Remover Produto</span></a>
                                  </td>
                          </tr>';

                         /* echo '<div class="row">
                                <div class="col-md-4 col-sm-6 portfolio-item ">
                                  <a href="'.get_the_permalink().'">
                                      <div class="hoverzoom">
                                          '.get_the_post_thumbnail (  rwmb_meta( 'orcamento_produto', null, $post->ID ), '', array(
                                                                      'class' => "img-responsive por-img",
                                                                      'desc' => trim( strip_tags( $post->post_title ) ) 
                                                                    )).'
                                      </div>
                                  </a>
                                  
                                  <p> <strong>'.get_the_title(rwmb_meta( 'orcamento_produto', null, $post->ID )).'</strong> <br>
                                  <p> <strong>Quantidade: '.rwmb_meta( 'orcamento_quantidade', null, $post->ID ).'</strong> <br>';
                              echo '</div>';
                              echo "</div>";*/


                              
                          $x++;
                      }

                        
                      echo '</table>';

                      ?>

                        <form name="enviaContatoOrcamento" id="enviaContatoOrcamento" onsubmit="enviarOrcamento(); return false;">
                          <table class="table tbl-orcamento">
                            <thead>
                              <tr>
                                <th colspan="4">Dados de Envio de Orçamento</th>
                              </tr>
                              <tr>
                                <td>
                                  <input type="text" required name="nomeContatoOrcamento" id="nomeContatoOrcamento" placeholder="Nome para contato">
                                </td>
                                <td>
                                  <input type="text" required name="empresaContatoOrcamento" id="empresaContatoOrcamento" placeholder="Empresa">
                                </td>
                                <td>
                                  <input type="email" required name="emailContatoOrcamento" id="emailContatoOrcamento" placeholder="E-mail">
                                </td>
                                <td>
                                  <input type="hidden" required name="action" id="action" value="contatoOrcamento">
                                  <button type="submit" class="btn btn-orcamento ">Solicitar Orçamento</button>
                                </td>
                              </tr>
                            </thead>
                          </table>
                        </form>

                      <?php

                      echo '</div><div id="divOrcamentoLog"></div>';
                    }
                    else{
                      echo "<h2>Selecione algum produto para solicitar seu orçamento.</h2>";
                    }
                ?>
                
        </div>
    </section>
    
<?php 
  get_footer(); 
?>
