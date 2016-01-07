<?php /* Template Name: Ajax*/ ?>
<?php 
	
	function cadastrarUsuario(){
		$userdata = array(
		    'user_login'  =>  filter_input(INPUT_POST, 'email'),
		    'first_name'    =>  filter_input(INPUT_POST, 'nome'),
		    'user_pass'   =>  'default',
		    'description'   =>  filter_input(INPUT_POST, 'telefone')
		);

		$user_id = wp_insert_user( $userdata ) ;

		wp_set_current_user($user_id, filter_input(INPUT_POST, 'email'));
        wp_set_auth_cookie($user_id);
        do_action('wp_login', filter_input(INPUT_POST, 'email'));
	}


	if(filter_input(INPUT_POST, 'action') == 'cadastrarUsuario'){
		die(cadastrarUsuario());
	}
?>