<?php 
session_start();
	function connectDB(){
			$host = 'localhost';
			$database = 'wp_fabio';
			$usuario = 'root';
			$senha = '#ShunGokuSatsu#';

			try{

			    // Conexao com banco MY Sql Server
			    $conn = new PDO( "mysql:host=$host; dbname=$database", $usuario, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;	

			}
			catch ( PDOException $e ){
			    echo $e->getMessage();
			}

	}


	function listarProdutos(){
		try{
			$conn = connectDB();
			$query = $conn->prepare( "SELECT idProduto, nomeProduto, imgProduto, descricaoProduto, precoProduto FROM tblProduto");
			$arrHtml;
			$x = 1;
			if($query->execute()){ 
				while ($consulta = $query->fetch( PDO::FETCH_OBJ ) ) {
					$btn;
					if(filter_input(INPUT_POST, 'isAdmin') == "true"){
						$btn = '<a class="btn btn-default" href="frmProduto.php?id='.$consulta->idProduto.'" role="button">Alterar</a>
								||
								<a class="btn btn-default" href="javascript:removerProduto('.$consulta->idProduto.')" role="button">Remover</a>';
					}
					else{
						$btn = '<a class="btn btn-default" href="detalhes.php?id='.$consulta->idProduto.'" role="button">Ver Mais »</a>';
					}
					$img = ($consulta->imgProduto != '' ? $consulta->imgProduto : 'http://www.clker.com/cliparts/f/Z/G/4/h/Q/no-image-available-md.png');
					$arrHtml .= '
						            <div class="col-lg-3">
						              <img class="img-circle" src="upload/produto/'.$img.'" width="140" height="140">
						              <h2>'.$consulta->nomeProduto.'</h2>
						              <p>'.$consulta->descricaoProduto.'</p>
						              <p>'.$btn.'</p>
						            </div>';
					if($x == 4){
						$arrHtml .= '
					            </div>
					            <br>
					            <div class="row">';
			    		$x = 0;        
			        }
		            $x++;
				}
			}
			if($arrHtml == ""){
		        $arrHtml .= '<div class="container listagem-aut">
		                        <div class="item-busca-aut">
		                            <div class="row" >
		                                <div id="results">
		                                    <div class="col-md-5">
		                                        <h4>Nenhum Resultado Encontrado!</h4>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>';
			}
			else{
				$arrHtml = '<div class="row">'.$arrHtml;
			}
			return json_encode(array('status' => true, 'busca' => $arrHtml, 'message' => ''));
		}
		catch ( PDOException $e ){
      		return json_encode(array('status' => false, 'busca' => $arrHtml, 'message' => $e->getMessage()));
		}
	}

	function getProduto($id){
		try{
			$conn = connectDB();
    
	        $query = $conn->prepare( "SELECT idProduto, nomeProduto, imgProduto, descricaoProduto, precoProduto 
	        							FROM tblProduto
	        							WHERE idProduto = :produto" );
	        $query->bindParam(':produto', $id);

	        if($query->execute()){          
	      		$produto = $query->fetch( PDO::FETCH_OBJ );
	      		$produto->precoProduto = number_format($produto->precoProduto, 2, ',', '.');
	      	}
      		return json_encode(array('status' => true, 'produto' => $produto, 'total' => count($produto)));
      	}
      	catch ( PDOException $e ){
      		return json_encode(array('status' => false, 'busca' => $arrHtml, 'message' => $e->getMessage()));
		}
	}
	
	function removeProduto($id){
		try{
			$conn = connectDB();
	    
	        $query = $conn->prepare( "DELETE FROM tblProduto where idProduto = :produto" );
	        $query->bindParam(':produto', $id);

	        $query->execute();
	      
	      $conn = null; 
	    
	    } 
	    catch (PDOException $e) {

	      return json_encode(array('status' => false, 'message' => "Erro ao efetuar ação: ".$e->getMessage()));
	    }

	    return json_encode(array('status' => true));
	}
	
	function alterarProduto($id){
		try{
			$conn = connectDB();
	    
	        $query = $conn->prepare( "UPDATE tblProduto SET 
	        							nomeProduto = :nome, 
	        							descricaoProduto = :descricao, 
	        							precoProduto = :preco
	        							where idProduto = :produto" );
	        $query->bindParam(':produto', $id);
	        $query->bindParam(':nome', filter_input(INPUT_POST, 'produto'));
	        $query->bindParam(':descricao', filter_input(INPUT_POST, 'descricao'));
	        $query->bindParam(':preco', filter_input(INPUT_POST, 'preco'));

	        $query->execute();
	      
	      $conn = null; 
	    
	    } 
	    catch (PDOException $e) {

	      return json_encode(array('status' => false, 'message' => "Erro ao efetuar ação: ".$e->getMessage()));
	    }

	    return json_encode(array('status' => true));
	}

	function inserirProduto(){
		try{
			$conn = connectDB();
	    
	        $query = $conn->prepare( "INSERT INTO tblProduto 
	        							(nomeProduto, descricaoProduto, precoProduto)
	        							values
	        							(:nome, :descricao, :preco)" );
	        $query->bindParam(':nome', filter_input(INPUT_POST, 'produto'));
	        $query->bindParam(':descricao', filter_input(INPUT_POST, 'descricao'));
	        $query->bindParam(':preco', filter_input(INPUT_POST, 'preco'));

	        $query->execute();
	      
	      $conn = null; 
	    
	    } 
	    catch (PDOException $e) {

	      return json_encode(array('status' => false, 'message' => "Erro ao efetuar ação: ".$e->getMessage()));
	    }

	    return json_encode(array('status' => true));
	}

	function cadastrarUsuario(){
		try{
			$conn = connectDB();
	    
	        $query = $conn->prepare( "INSERT INTO tblCliente 
	        							(nomeCliente, emailCliente, telefoneCliente)
	        							values
	        							(:nome, :email, :telefone)" );
	        $query->bindParam(':nome', filter_input(INPUT_POST, 'nome'));
	        $query->bindParam(':email', filter_input(INPUT_POST, 'email'));
	        $query->bindParam(':telefone', filter_input(INPUT_POST, 'telefone'));

	        if($query->execute()){
	        	$query = $conn->prepare( "SELECT max(idCliente) as lastCliente FROM tblCliente" );
	        	$query->execute();
	        	$consulta = $query->fetch( PDO::FETCH_OBJ );
	        	$_SESSION['cliente'] = $consulta->lastCliente;
	        }
	      
	      $conn = null; 
	    
	    } 
	    catch (PDOException $e) {

	      return json_encode(array('status' => false, 'message' => "Erro ao efetuar ação: ".$e->getMessage()));
	    }

	    return json_encode(array('status' => true, 'cliente' => $_SESSION['cliente']));
	}

	function login($email){
		try{
			$conn = connectDB();
    
	        $query = $conn->prepare( "SELECT idCliente FROM tblCliente
	        							WHERE emailCliente = :email" );
	        $query->bindParam(':email', $email);

	        if($query->execute()){          
	      		$cliente = $query->fetch( PDO::FETCH_OBJ );
	      		$_SESSION['cliente'] = $cliente->idCliente;
	      	}

      		return json_encode(array('status' => true));
      	}
      	catch ( PDOException $e ){
      		return json_encode(array('status' => false));
		}
	}


	function registrarPedido($cliente, $produto){
		try{
			$conn = connectDB();
	    
	        $query = $conn->prepare( "INSERT INTO tblPedido 
	        							(idCliente, idProduto)
	        							values
	        							(:cliente, :produto)" );
	        $query->bindParam(':cliente', $cliente);
	        $query->bindParam(':produto', $produto);

	        $query->execute();
	      
	      $conn = null; 
	    
	    } 
	    catch (PDOException $e) {

	      return json_encode(array('status' => false, 'message' => "Erro ao efetuar ação: ".$e->getMessage()));
	    }

	    return json_encode(array('status' => true, 'cliente' => $_SESSION['cliente']));
	}



	if(filter_input(INPUT_POST, 'action') == 'listarProdutos'){
		die(listarProdutos());
	}
	if(filter_input(INPUT_POST, 'action') == 'getProduto'){
		die(getProduto(filter_input(INPUT_POST, 'id')));
	}
	if(filter_input(INPUT_POST, 'action') == 'removeProduto'){
		die(removeProduto(filter_input(INPUT_POST, 'id')));
	}
	if(filter_input(INPUT_POST, 'action') == 'alterarProduto'){
		die(alterarProduto(filter_input(INPUT_POST, 'id')));
	}
	if(filter_input(INPUT_POST, 'action') == 'inserirProduto'){
		die(inserirProduto());
	}
	if(filter_input(INPUT_POST, 'action') == 'cadastrarUsuario'){
		die(cadastrarUsuario());
	}
	if(filter_input(INPUT_POST, 'action') == 'login'){
		die(login(filter_input(INPUT_POST, 'emailLogin')));
	}
	if(filter_input(INPUT_POST, 'action') == 'registrarPedido'){
		die(registrarPedido(filter_input(INPUT_POST, 'cliente'), filter_input(INPUT_POST, 'produto')));
	}

		
	//connectDB();
?>