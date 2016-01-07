<?php

function restrict_admin() {
    if (!current_user_can('manage_options') && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF']) {
        wp_redirect(site_url());
    }
}

//ADICIONAR URL VAR
function add_query_vars_filter($vars) {
    $vars[] = "q";
    $vars[] = "prodID";
    return $vars;
}
add_filter('query_vars', 'add_query_vars_filter');

/*PASSANDO VALORES PELA URL*/


function add_rewrite_rules_print($aRules) {
    $aNewRules = array('^pedido/([^/]+)/?' => '/index.php?page_id=12&prodID=$matches[1]');
    $aRules = $aNewRules + $aRules;
    return $aRules;
}
add_filter('rewrite_rules_array', 'add_rewrite_rules_print');

global $meta_boxes;
$meta_boxes = array();
$meta_boxes[] = array(
    'id' => 'qs_confs',
    'title' => 'Informações da Home',
    'pages' => array('page-home'),//não existe só corrige incompatibilidade
    'fields' => array(
        array(
            'type' => 'heading',
            'name' => 'Foto de capa',
            'id' => 'fake_id', // Not used but needed for plugin
        ),
        array(
            'name' => 'Imagem da Home (telas grandes)',
            'id' => 'capa_img',
            'type' => 'image',
        ),
        array(
            'name' => 'imagem da home (telas pequenas)',
            'id' => 'capa_img_baixa',
            'type' => 'image',
        ),
      )
    );


add_action('init', 'produto_posttype');
function produto_posttype() {
    $labels = array(
        'name' => __('Produtos', 'post type general name'),
        'singular_name' => __('Produto', 'post type singular name'),
        'add_new' => __('Adicionar'),
        'add_new_item' => __('Adicionar'),
        'edit_item' => __('Editar'),
        'new_item' => __('Adicionar'),
        'all_items' => __('Ver todos'),
        'view_item' => __('Ver pagina'),
        'search_items' => __('Buscar...'),
        'not_found' => __('Nenhum item cadastrado até o momento.'),
        'not_found_in_trash' => __('A lixeira esta vazia.'),
        'parent_item_colon' => '',
        'menu_name' => 'Produtos'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => array('title','thumbnail', 'editor') //'editor', 'thumbnail', 'excerpt',
    );
    register_post_type('produto', $args);
}

$meta_boxes[] = array(
    'id' => 'produto_confs',
    'title' => 'Produtos',
    'pages' => array('produto'),
    'fields' => array(
        array(
            'name' => 'Valor R$?',
            'id' => 'produto_valor',
            'type' => 'text',
            'desc' => 'Ex: 0,00'
        ),
    ),
);


add_action('init', 'pedido_posttype');
function pedido_posttype() {
    $labels = array(
        'name' => __('Pedidos', 'post type general name'),
        'singular_name' => __('Pedido', 'post type singular name'),
        'add_new' => __('Adicionar'),
        'add_new_item' => __('Adicionar'),
        'edit_item' => __('Editar'),
        'new_item' => __('Adicionar'),
        'all_items' => __('Ver todos'),
        'view_item' => __('Ver pagina'),
        'search_items' => __('Buscar...'),
        'not_found' => __('Nenhum item cadastrado até o momento.'),
        'not_found_in_trash' => __('A lixeira esta vazia.'),
        'parent_item_colon' => '',
        'menu_name' => 'Pedidos'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => array('title','thumbnail', 'editor') //'editor', 'thumbnail', 'excerpt',
    );
    register_post_type('pedido', $args);
}

$meta_boxes[] = array(
    'id' => 'pedido_confs',
    'title' => 'Pedido',
    'pages' => array('pedido'),
    'fields' => array(
        array(
            'name' => 'Produto',
            'id' => 'produto_pedido_id',
            'type' => 'text'
        ),
        array(
            'name' => 'Cliente',
            'id' => 'cliente_id',
            'type' => 'text'
        ),
    ),
);


function register_meta_boxes() {
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if (!class_exists('RW_Meta_Box'))
        return;

    global $meta_boxes;
    foreach ($meta_boxes as $meta_box) {
        new RW_Meta_Box($meta_box);
    }
}
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
add_action('admin_init', 'register_meta_boxes');
?>