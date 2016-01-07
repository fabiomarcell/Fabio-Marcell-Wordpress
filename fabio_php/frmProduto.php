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
    <link href="css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

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
                  <li><a href="index.php">Home</a></li>
                  <li class="active"><a href="adminProdutos.php">Controle de Produtos</a></li>
                  <li><a href="frmProduto.php">Novo Produto</a></li>
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
          <div class="row" id="result">
            
            <div class="col-lg-12">

              <form role="form">
                <div class="form-group">
                  <label for="produto">Produto:</label>
                  <input type="text" class="form-control" id="produto" name="produto" required>
                </div>
                <div class="form-group">
                  <label for="descricao">Descrição:</label>
                  <input type="text" class="form-control" id="descricao" name="descricao" required>
                </div>
                <div class="form-group">
                  <label for="preco">Preço:</label>
                  <input type="text" class="form-control" id="preco" required name="preco" placeholder="0000.00">
                </div>
                
                  <?php
                    if(filter_input(INPUT_GET, 'id') != ""){
                      echo '<a class="btn btn-default" href="javascript:alterarProduto('.filter_input(INPUT_GET, 'id').');" role="button" id="link">Alterar</a>';
                    }
                    else{
                      echo '<a class="btn btn-default" href="javascript:inserirProduto();" role="button" id="link">Cadastrar</a>';
                    }
                  ?>  
                </p>
              </form>
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
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="ajax.js"></script>
    <script>
      <?php
        if(filter_input(INPUT_GET, 'id') != ""){
        ?>
          $(window).ready(function(){
            getProdutoUpdate("<?=filter_input(INPUT_GET, 'id')?>");
          });
        <?php
        }
        ?>
    </script>
    
  </body>
</html>
