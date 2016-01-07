<?php
  /*
  Template Name: Home Page
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Fabio Marcell - PHP</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=get_bloginfo('template_url')?>/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom styles for this template -->
    <link href="<?=get_bloginfo('template_url')?>/css/cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Fabio Marcell</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="index.php">Home</a></li>
                  <li><a href="adminProdutos.php">Controle de Produtos</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <!--<div class="inner cover">
            <h1 class="cover-heading">Cover your page.</h1>
            <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
            <p class="lead">
              <a href="#" class="btn btn-lg btn-default">Learn more</a>
            </p>
          </div>-->
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
                          <p><a class="btn btn-default" href="" role="button">Ver Mais »</a></p>
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
          <div class="mastfoot">
            <div class="inner">
              
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=get_bloginfo('template_url')?>/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?=get_bloginfo('template_url')?>/js/bootstrap.min.js"></script>
    <script src="ajax.js"></script>
    <script>
        $(window).ready(function(){
          listarProdutos(false);
        });
    </script>
    
  </body>
</html>
