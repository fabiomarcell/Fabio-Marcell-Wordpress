<?php
  /*
  Template Name: pedido
 */

  get_header(); 
  if ( is_user_logged_in() ) {
?>

          <div id="resultPedido">
              <?php 
                $page = get_page_by_path(get_query_var( 'prodID'), OBJECT, 'produto');
                $post = array(
                          'post_title' => 'Novo Pedido',
                          'post_status' => 'publish',
                          'post_type' => 'pedido'
                        );
                $post_id = wp_insert_post($post);
                update_post_meta($post_id, 'produto_pedido_id', $page->ID);
                update_post_meta($post_id, 'cliente_id', get_current_user_id());
              ?>
              Pedido Registrado com Sucesso!
          </div>
         

<?php
  }
  else{
     wp_redirect(get_permalink(14));
  }
  get_footer();
?>