<?php /* Template Name: Ajax*/ ?>

<?php //wp_head(); ?>

<?php
	ini_set('display_errors', '1');
	//die(var_dump($_POST));
	$action = filter_input(INPUT_POST, "action");
	if( $action == 'email'){

		require_once(get_template_directory().'/PHPMailer/PHPMailerAutoload.php');

		$nome 	= filter_input(INPUT_POST, "nome");
		$email 	= filter_input(INPUT_POST,"email");
		$tel 	= filter_input(INPUT_POST,"phone");
		$text 	= filter_input(INPUT_POST,"text");

		$mail = new PHPMailer;
		$mail->IsSMTP();		// Ativar SMTP
		$mail->IsHTML(true);  
		$mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;		// Autenticação ativada
		$mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail
		$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
		$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
		$mail->Username = "aasmoto@gmail.com";
		$mail->Password = "aasmoto10";
		$mail->SetFrom("aasmoto@gmail.com", "Contato NotCake");
		$mail->Subject  =   "Formulário de contato do site | " . date("d/m/Y");  
		$mail->Body = "Novo contato feito através do site.<br>
        				De ".$nome.", ".$email.".<br>
        				Telefone: ".$tel."<br>
        				Mensagem:<br>".$text;  
        //$mail->AltBody = $mail->Body;  
        $mail->CharSet="UTF-8";
		$mail->AddAddress("aasmoto@gmail.com");
		if(!$mail->Send()) {
			die(json_encode(array("status" => false, "message" => 'Mail error: '.$mail->ErrorInfo))); 
		} else {
			die(json_encode(array("status" => true, "message" => "Mensagem Enviada!")));
		}
	}
	else if($action == 'addOrcamento'){
		//die(var_dump($_SERVER['REMOTE_ADDR']));
		$qtd 		= filter_input(INPUT_POST, "quantidade");
		$produto 	= filter_input(INPUT_POST, "item");
		$ip 		= $_SERVER['REMOTE_ADDR'];
		

			$novo_post = array(
			  'post_title'			=> 'Orçamento IP: '.$ip, 
			  'post_author'			=> 1,
			  'post_status'			=> 'publish', 
			  'post_type'			=> 'orcamento'
  			);
  			$novo_id = wp_insert_post( $novo_post );
  			update_post_meta($novo_id, 'orcamento_ip', $ip);
  			update_post_meta($novo_id, 'orcamento_produto', $produto);
  			update_post_meta($novo_id, 'orcamento_quantidade', $qtd);
  			update_post_meta($novo_id, 'orcamento_status', '0');

		
	}
	else if($action == 'salvarOrcamento'){
		$produto 	= filter_input(INPUT_POST, "item");
		$qtd 	= filter_input(INPUT_POST, "qtdItem");
		$args = array(
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
                              'value' => $produto,
                            ),
                          ) 
                        );
		$mypost = get_posts($args);
		foreach($mypost as $post){
			update_post_meta($post->ID, 'orcamento_quantidade', $qtd);
		}
		die(json_encode(array("status" => true, "qtd" => $qtd)));
	}
	else if($action == "removerOrcamento"){
		$produto 	= filter_input(INPUT_POST, "item");
		$args = array(
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
                              'value' => $produto,
                            ),
                          ) 
                        );
		$mypost = get_posts($args);
		foreach($mypost as $post){
			wp_delete_post($post->ID);
		}
		die(json_encode(array("status" => true)));
	}
	else if($action == 'contatoOrcamento'){
		$args = array(
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

		$mypost = get_posts($args);
		$produtos;
		$x = 0;
		if(count($mypost) > 0){
			$produtos .= '<div class="col-md-10 col-md-offset-1">'. 
                    	'<table class="table tbl-orcamento" style="width:100%" border="1">
                    		<thead>
                    			<tr>
                    				<th></th>
                					<td>Produto</td>
                					<td>Quantidade</td>
                					<td>Valor Unitário</td>
                					<td>Valor Total</td>
            					</tr>
        					</thead>';
                      foreach ($mypost as $post) {
                        $produtoID = rwmb_meta( 'orcamento_produto', null, $post->ID );

                          $produtos .= '<tr class="linha'.$produtoID.'">
                                  <td>
                                    <p>'.get_the_post_thumbnail (  $produtoID, '', array(
                                                                      'style' => "width:100px;",
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
                                    </div>  
                                  </td>
                                  <td>
                                  	R$: '.rwmb_meta( 'produto_valor', null, $produtoID ).'
                                  </td>
                                  <td>
                                  	R$: '.number_format(str_replace(",", ".", rwmb_meta( 'produto_valor', null, $produtoID )) * rwmb_meta( 'orcamento_quantidade', null, $post->ID ), 2 , ',', '.').'
                                  </td>
                          </tr>';

                          $x += number_format(str_replace(",", ".", rwmb_meta( 'produto_valor', null, $produtoID )) * rwmb_meta( 'orcamento_quantidade', null, $post->ID ), 2 , ',', '.');
                          update_post_meta($post->ID, 'orcamento_status', '1');
                      }

                        
                      $produtos .= '	<tr>
                      						<td></td>
                      						<td></td>
                      						<td></td>
                      						<td>Total do Orçamento</td>
                      						<td>R$: '.number_format($x, 2 , ',', '.').'</td>                      						
                      					</tr>
                      				</table>';
		}
		else{
			die(json_encode(array("status" => false, "message" => 'nenhum Itens em orçamento'))); 
		}
		require_once(get_template_directory().'/PHPMailer/PHPMailerAutoload.php');

		$nome 		= filter_input(INPUT_POST, "nomeContatoOrcamento");
		$contato 	= filter_input(INPUT_POST, "empresaContatoOrcamento");
		$email 		= filter_input(INPUT_POST, "emailContatoOrcamento");

		$mail = new PHPMailer;
		$mail->IsSMTP();		// Ativar SMTP
		$mail->IsHTML(true);  
		$mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;		// Autenticação ativada
		$mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail
		$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
		$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
		$mail->Username = "aasmoto@gmail.com";
		$mail->Password = "aasmoto10";
		$mail->SetFrom($email, $nome);
		$mail->Subject  =   "Solicitação de Orçamento | ".$nome." - ".$contato." | " . date("d/m/Y");  
		$mail->Body = 	"Solicitante do Orçamento: ".$nome.", ".$email."<br>".
						"Empresa Solicitante: ".$contato."<br>".
						"<br><br>
						<span>Itens Solicitados no Orçamento</span><br><br>".
						$produtos;  
        //$mail->AltBody = $mail->Body;  
        $mail->CharSet="UTF-8";
		$mail->AddAddress("aasmoto@gmail.com");
		if(!$mail->Send()) {
			die(json_encode(array("status" => false, "message" => 'Mail error: '.$mail->ErrorInfo))); 
		} else {
			die(json_encode(array("status" => true, "message" => "Mensagem Enviada!")));
		}

	}
?>