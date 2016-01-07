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
    
    <script>
      function cadastrarUsuario(){
        var dados = {
                      action: 'cadastrarUsuario', 
                      nome: $("#nomeCadastro").val(),
                      email: $("#emailCadastro").val(),
                      telefone: $("#telefoneCadastro").val()
                    };
        $.ajax({
          url: '<?=get_permalink(16)?>',
          type: 'POST',
          data: dados,
          dataType: "json",
          success: function(resposta) {
            window.location = '<?=get_permalink(4)?>';
          }
        });
      }

    </script>
  </body>
</html>