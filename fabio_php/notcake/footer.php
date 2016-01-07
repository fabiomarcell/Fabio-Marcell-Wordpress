<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
 <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Fale Conosco.</h2>
                    <h3 class="section-subheading text-muted">Entre em contato para esclarecer qualquer dúvida sobre nossos serviços.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="envia" onsubmit="sendAjaxEmail(); return false;" action="<?=get_permalink(39)?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Seu Nome *" id="name" name="nome" required data-validation-required-message="Informe seu Nome.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Seu E-mail *" id="email" name="email" required data-validation-required-message="Informe um E-mail válido.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Telefone de Contato *" id="phone" name="phone" required data-validation-required-message="Informe um telefone para contato.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Deixe sua Mensagem *" id="message" name="text" required data-validation-required-message="Informe a mensagem de envio.."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="msgAjaxEmail" style=" display: none; color: #FFF; font-weight: bold; font-size: 20px; padding: 10px; margin: 10px; opacity: 0.9;"></div>
                                <input type="hidden" value="email" name="action">
                                <button type="submit" class="btn btn-xl">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; AAS Moto Peças 2015</span>
                </div>
                <div class="col-md-4">
                </div>
                    <ul class="list-inline quicklinks">
                        <li>
                            Desenvolvido por: 
                        </li>
                        <li>
                            <a href="http://notcake.com.br" target="_BLANK">!Cake</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    
    <!-- jQuery -->
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/classie.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php bloginfo('template_url'); ?>/js/jqBootstrapValidation.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php bloginfo('template_url'); ?>/js/agency.js"></script>

     <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/mask.js"></script>





    <script>



        $(document).ready(function() {
         
          $("#owl-demo").owlCarousel({
         
              autoPlay: 3000, //Set AutoPlay to 3 seconds
         
              items : 3,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3]
         
          });
         
        });


         
         

    </script>
    <script>
      function sendAjaxEmail(){
        $("#msgAjaxEmail").fadeIn();
        $("#msgAjaxEmail").html("Aguarde...");
        $.ajax({
            type: "POST",
            url: "<?=get_permalink(39)?>",
            processData: false,
            data: $("#envia").serialize(),
            dataType: 'json',
            success: function (data) {
                $("#msgAjaxEmail").html(data.message);
                if(data.status){
                  setTimeout(function(){ $("#envia").fadeOut(); }, 5000);
                }
                else{
                    console.log(data);
                }
            }
        });
      }
      jQuery(function($){
        $("#phone").mask("(99) 9999-9999?9");
      });

      function setOrcamento(formOrcamento){
        $.ajax({
            type: "POST",
            url: "<?=get_permalink(39)?>",
            processData: false,
            data: $("#"+formOrcamento).serialize(),
            //dataType: 'json',
            success: function (data) {
                //$("#msgAjaxEmail").html(data.message);
                //console.log(data);
                
                $("#"+formOrcamento).fadeOut('slow');
                
                setTimeout(function(){ 
                    $("#"+formOrcamento).html('<button class="btn btn-orcamento" type="button"><i class="fa fa-minus-circle"></i> Produto Inserido no Orçamento </button> </p>');
                }, 1000);                
                
                setTimeout(function(){ 
                    $("#"+formOrcamento).fadeIn('slow');
                }, 1000);
            }
        });

      }

      function editarOrcamento(produtoID){
        $(".editar" + produtoID).fadeOut("slow");
        setTimeout(function(){ $(".manutencao" + produtoID).fadeIn("slow"); }, 1000);
      }
      function cancelarOrcamento(produtoID){
        $(".manutencao" + produtoID).fadeOut("slow");
        setTimeout(function(){ $(".editar" + produtoID).fadeIn("slow"); }, 1000);
      }
      function salvarOrcamento(produtoID){
        $.ajax({
            type: "POST",
            url: "<?=get_permalink(39)?>",
            //processData: false,
            data: { 
                qtdItem: $("#qtd" + produtoID).val(), 
                item: produtoID, 
                action: "salvarOrcamento"
            },
            dataType: 'json',
            success: function (data) {
                $(".quantidade"+produtoID).html(data.qtd);
                cancelarOrcamento(produtoID)
                //console.log(data);
            }
        });
      }
      function removerOrcamento(produtoID){
        $.ajax({
            type: "POST",
            url: "<?=get_permalink(39)?>",
            //processData: false,
            data: { 
                item: produtoID, 
                action: "removerOrcamento"
            },
            dataType: 'json',
            success: function (data) {
                $(".linha"+produtoID).fadeOut();
                
                //console.log(data);
            }
        });
      }
      function enviarOrcamento(){
        $.ajax({
            type: "POST",
            url: "<?=get_permalink(39)?>",
            processData: false,
            data: $("#enviaContatoOrcamento").serialize(),
            dataType: 'json',
            success: function (data) {
                if(data.status == true){
                    $("#divOrcamento").html("<span>Orçamento Enviado com sucesso!<br>Selecione algum produto para solicitar seu orçamento.</span>");
                    //<h2>Selecione algum produto para solicitar seu orçamento.</h2>
                }
                else{
                    $("#divOrcamentoLog").html("<span>Houve uma falha no envio do orçamento, tente novamente mais tarde.</span>");
                }
            }
        });
      }
    </script>


</body>

</html>