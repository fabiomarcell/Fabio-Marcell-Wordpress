<?php 
  /*
  Template Name: cadastro
 */
  get_header();
?>
          <div class="row" id="result">
            
            <div class="col-lg-6">

              <form action="<?php echo home_url(); ?>/wp-login.php" method="post" name="loginform" id="loginform" >
                <div class="form-group">
                  <h1>Já cadastrado</h1>
                  <label for="emailLogin">Email:</label>
                  <input type="email" class="form-control" name="log" id="user_email" name="emailLogin" required>
                  <input type="hidden" class="form-control" name="pwd" id="user_pass" name="emailLogin" required value="default">
                  <span id="resLogin" style="color:#F00;"></span>
                </div>
                  <p><a class="btn btn-default" href="javascript:document.getElementById('loginform').submit()" role="button" id="link">Login</a></p>
              </form>
            </div>
            <div class="col-lg-6">

              <form role="form">
                <div class="form-group">
                  <h1>Novo Cadastro</h1>
                  <label for="nomeCadastro">Nome:</label>
                  <input type="text" class="form-control" id="nomeCadastro" name="nomeCadastro" required>
                </div>
                <div class="form-group">
                  <label for="emailCadastro">Email:</label>
                  <input type="email" class="form-control" id="emailCadastro" name="emailCadastro" required>
                </div>
                <div class="form-group">
                  <label for="telefoneCadastro">Telefone:</label>
                  <input type="text" class="form-control" id="telefoneCadastro" name="telefoneCadastro" required>
                </div>
                  <p><a class="btn btn-default" href="javascript:cadastrarUsuario();" role="button" id="link">Cadastrar</a></p>
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

<?php 
  get_footer();
?>
