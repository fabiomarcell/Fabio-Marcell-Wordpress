<?php
  /* Template Name: Page Produto*/
  get_header(); 
?>
<style>

        .hoverzoom {
            position: relative;
            width: 350px;
            overflow: hidden;
            padding:0 !important;
            
        }
        .hoverzoom > img {
           width: 100%; 
           margin-bottom:20px;
            border-radius: 2px;
            -webkit-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                -moz-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                 -ms-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                  -o-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                     transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
        }
        .hoverzoom:hover > img {
            -webkit-transform: scale(1.5);
               -moz-transform: scale(1.5);
                -ms-transform: scale(1.5);
                 -o-transform: scale(1.5);
                    transform: scale(1.5);
        }
        .hoverzoom .retina{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;    
            background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);    
            border-radius: 2px;
            text-align: center;
            padding: 30px;
         
            -webkit-transition:  all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                -moz-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                 -ms-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                  -o-transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000);
                     transition: all .8s cubic-bezier(.190, 1.000, .220, 1.000); 
        }
        .hoverzoom:hover .retina {
            opacity: 1;
            box-shadow: inset 0 0 100px 50px rgba(0,0,0,.5);
            
        }
        .hoverzoom .retina p {
            color: #fff;
        }
        .hoverzoom .retina a {
            display: block;
            width: 150px;
            background: #6fc5e9;
            border: 1px solid #59afd4;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            text-align: center;
            padding: 10px 15px;
            margin: 16px auto 0;
        }
    </style>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Nossos Produtos!</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <?php 
                    $args = array(
                      'posts_per_page'   => -1,
                      'orderby'          => 'date',
                      'order'            => 'ASC',
                      'post_type'        => 'produto',
                      'post_status'      => 'publish',
                      'meta_query' => array(
                                        'relation' => 'AND',
                                         array(
                                              'key' => 'produto_status',
                                              'value' => '1',
                                          ),
                                      ) 
                    );
                    $myposts = get_posts($args);
                    $x = 1;
                    foreach ($myposts as $post) {
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
                              'value' => $post->ID,
                            ),
                          ) 
                        );
                        $mypostsOrcamento = get_posts($argsOrcamento);
                        
                        echo '<div class="col-md-4 col-sm-6 portfolio-item ">
                                <a href="'.get_the_permalink().'">
                                    <div class="hoverzoom">
                                        '.get_the_post_thumbnail ( $post->ID, '', array(
                                                                    'class' => "img-responsive por-img",
                                                                    'desc' => trim( strip_tags( $post->post_title ) ) 
                                                                  )).'
                                    </div>
                                </a>
                                
                                <p> <strong>'.get_the_title().'</strong> <br>';
                                if(count($mypostsOrcamento) > 0){
                                  echo '<button class="btn btn-orcamento" type="button"><i class="fa fa-minus-circle"></i> Produto Inserido no Orçamento </button> </p>';
                                }
                                else{ 
                        ?>
                              
                                  <form id="enviaOrcamento<?=get_the_ID()?>" method="POST" action="<?=get_permalink(39)?>" onsubmit="setOrcamento('enviaOrcamento<?=get_the_ID()?>'); return false;">
                                    <button class="btn btn-orcamento " type="submit"><i class="fa fa-plus-circle"></i> Solicite seu orçamento</button>
                                    <input type="hidden" name="quantidade" id="quantidade" value="1">
                                    <input type="hidden" name="item" id="item" value="<?=get_the_ID()?>">
                                    <input type="hidden" name="action" id="action" value="addOrcamento">
                                  </form>
                        <?php
                                }
                                
                            echo '</div>';
                        if($x % 3 == 0){
                            echo "</div><div class='row'>";
                        }
                        $x++;
                    }
                ?>
            </div>
            
                
                
        </div>
    </section>
    
<?php 
  get_footer(); 
?>
