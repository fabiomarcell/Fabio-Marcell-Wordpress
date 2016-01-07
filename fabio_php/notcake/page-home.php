<?php
  /* Template Name: Page Home*/
  get_header(); 
?>



    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">O melhor remédio para a sua moto.</div>
                <div class="intro-heading">Desde 1989</div>
                <a href="#about" class="page-scroll btn btn-xl">Conheça nossa empresa!</a>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Sobre.</h2>
                    <h3 class="section-subheading text-muted">
                        AAS Moto Peças Indústria e comércio desde 1989 na estrada com você! <br>
                        Produzindo o melhor para sua motocicleta em filtros de ar, e guarnições para a ponteira de escapamento de motocicletas.
                    </h3>
                </div>
            </div>
            
    </section>

    <style>

        .hoverzoom {
            position: relative;
            width: 350px;
            overflow: hidden;
            padding:0 !important;
            background-color:#FFF;
            text-align:center;
            padding-bottom:20px !important;
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

        #owl-demo .item{
  margin: 3px;
}
#owl-demo .item img{
  display: block;
  width: 100%;
  height: auto;
}




    </style>

    <!-- Portfolio Grid Section -->
    <section id="produtos" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Nossos Produtos!</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item hoverzoom">
                    <img src="<?php bloginfo('template_url'); ?>/img/portfolio/golden.png" class="img-responsive" alt="">
                    <strong>Guarnições</strong>
                </div>
                <div class="col-md-4 col-sm-6 ">
                    
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item hoverzoom" >
                    <img src="<?php bloginfo('template_url'); ?>/img/portfolio/dreams.png" class="img-responsive" alt="">
                    <strong>Filtros de Ar</strong>
                </div>
            </div>
        </div>
        <a href="<?=get_the_permalink(25)?>" class="page-scroll btn btn-xl" style="margin:0 auto; display:block; width:80%; margin-top:50px;">Confira aqui todos os nossos produtos!</a>
    </section>

    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Clientes e Parceiros!</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <!--
            <div class="row clientes">
                
              <?php 
                $args = array(
                  'posts_per_page'   => -1,
                  'orderby'          => 'date',
                  'order'            => 'ASC',
                  'post_type'        => 'cliente',
                  'post_status'      => 'publish',
                    'meta_query' => array(
                      'relation' => 'AND',
                        array(
                          'key' => 'cliente_status',
                          'value' => '1',
                        )
                  ) 
                );
                $myposts = get_posts($args);
                $x = 1;
                foreach ($myposts as $post) {  setup_postdata( $post );
                  
              ?>
                  <div class="col-md-3 col-sm-6">
                      <a href="<?=rwmb_meta('cliente_url', null, $post->ID)?>" target='blank'>
                          <?php echo get_the_post_thumbnail ( $post->ID, '', array(
                                                                    'class' => "img-responsive por-img",
                                                                    'desc' => trim( strip_tags( $post->post_title ) ) 
                                                                  )); ?>
                      </a>
                  </div>
              <?php 
                }
              ?>    
            </div>-->

            <div class="row">
                
                <div id="owl-demo">
                          
                    <?php 
                        $args = array(
                          'posts_per_page'   => -1,
                          'orderby'          => 'date',
                          'order'            => 'ASC',
                          'post_type'        => 'cliente',
                          'post_status'      => 'publish',
                            'meta_query' => array(
                              'relation' => 'AND',
                                array(
                                  'key' => 'cliente_status',
                                  'value' => '1',
                                )
                          ) 
                        );
                        $myposts = get_posts($args);
                        $x = 1;
                        foreach ($myposts as $post) {  setup_postdata( $post );
                          
                    ?>
                        <div class="item">
                            <a href="<?=rwmb_meta('cliente_url', null, $post->ID)?>" target='blank'>
                                <?php echo get_the_post_thumbnail ( $post->ID, '', array(
                                                                    'class' => "img-responsive por-img",
                                                                    'desc' => trim( strip_tags( $post->post_title ) ),
                                                                    'alt' => trim( strip_tags( $post->post_title ) )
                                                                  )); 
                                ?>
                            </a>
                        </div>
                    <?php 
                        }
                    ?>

                </div>
            </div>
        </div>
    </aside>
    


<?php 
  get_footer(); 
?>
