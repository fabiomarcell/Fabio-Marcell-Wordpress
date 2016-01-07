<?php
//ini_set('display_errors', 1);
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}
show_admin_bar(false);
/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	//require get_template_directory() . '/inc/back-compat.php';
}


	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

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

add_action('init', 'cliente_posttype');
function cliente_posttype() {
    $labels = array(
        'name' => __('Clientes', 'post type general name'),
        'singular_name' => __('Clientes', 'post type singular name'),
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
        'menu_name' => 'Cliente'
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
        'supports' => array('title','thumbnail') //'editor', 'thumbnail', 'excerpt',
    );
    register_post_type('cliente', $args);
}

$meta_boxes[] = array(
    'id' => 'cliente_configs',
    'title' => 'Clientes e Parceiros',
    'pages' => array('cliente'),
    'fields' => array(
        array(
            'name' => 'Ativo?',
            'id' => 'cliente_status',
            'type' => 'checkbox',
            'std' => '1'
        ),
        array(
            'name' => 'URL',
            'id' => 'cliente_url',
            'type' => 'url'
        ),
        
    ),
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
    'title' => 'Guarnições e Filtros de Ar',
    'pages' => array('produto'),
    'fields' => array(
        array(
            'name' => 'Ativo?',
            'id' => 'produto_status',
            'type' => 'checkbox',
            'std' => '1'
        ),
        array(
            'name' => 'Valor R$?',
            'id' => 'produto_valor',
            'type' => 'text',
            'desc' => 'Ex: 0,00'
        ),
    ),
);


add_action('init', 'orcamento_posttype');
function orcamento_posttype() {
    $labels = array(
        'name' => __('Orcamento', 'post type general name'),
        'singular_name' => __('Orcamento', 'post type singular name'),
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
        'menu_name' => 'Orçamento'
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
        'supports' => array('title') //'editor', 'thumbnail', 'excerpt',
    );
    register_post_type('orcamento', $args);
}

$meta_boxes[] = array(
    'id' => 'orcamento_confs',
    'title' => 'Orçamento',
    'pages' => array('orcamento'),
    'fields' => array(
        array(
            'name' => 'IP(Identificador)',
            'id' => 'orcamento_ip',
            'type' => 'text'
        ),
        array(
            'name' => 'Produto',
            'id' => 'orcamento_produto',
            'type'        => 'post',
            'post_type'   => 'produto',
            'field_type'  => 'select_advanced',
        ),

        array(
            'name' => 'Quantidade',
            'id' => 'orcamento_quantidade',
            'type' => 'number'
        ),
        array(
                'name'        => "Status",
                'id'          => "orcamento_status",
                'type'        => 'select',
                // Array of 'value' => 'Label' pairs for select box
                'options'     => array(
                    "0" => "Novo",
                    "1" => "Solicitado",
                )
            ),
    ),
);



/*Taxonomies*/
function tipo_init() {
    // create a new taxonomy
    register_taxonomy(
        'tipo',
        array('produto'),
        array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite' => array( 'slug' => 'tipo' ),
        )
    );
}
add_action( 'init', 'tipo_init' );

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


// PREVINE USUARIOS DE DELETAR PAGINAS DE SISTEMA
add_action('wp_trash_post', 'prevent_post_deletion');