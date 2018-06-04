<?php

// adicionar imagem destacada
add_theme_support('post-thumbnails');

// renomeia post padrão 
function revcon_change_post_object() {
	$get_post_type = get_post_type_object('post');
	$labels = $get_post_type->labels;
	$labels->name = 'Evento';
	$labels->singular_name = 'Evento';
	$labels->add_new = 'Novo Evento';
	$labels->add_new_item = 'Novo Evento';
	$labels->edit_item = 'Editar Evento';
	$labels->new_item = 'Evento';
	$labels->view_item = 'Ver Evento';
	$labels->search_items = 'Buscar Evento';
	$labels->not_found = 'Nenhum Evento encontrado';
	$labels->not_found_in_trash = 'Nenhum Evento encontrado na Lixeira';
	$labels->all_items = 'Todos os Eventos';
	$labels->menu_name = 'Evento';
	$labels->name_admin_bar = 'Evento';
	//Change menu icon
	$get_post_type->menu_icon = 'dashicons-calendar-alt';
}

add_action( 'init', 'revcon_change_post_object' );

// remove categorias e tags
function remove_tax() {
    register_taxonomy('category', array());
    register_taxonomy('post_tag', array());
}

add_action('init', 'remove_tax');

// adiciona taxonomia de cidade
function taxonomia_cidade() {
    
    $nome = 'Cidade';
	
    $labels = array(
        'name' => $nome,
        'singular_name' => $nome,
        'add_new_item' => 'Adicionar nova ' . $nome,
        'edit_item' => 'Editar ' . $nome,
        'not_found' => 'Nenhuma ' . $nome . ' encontrada'   
    );
	
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true
    );
	
    register_taxonomy('cidade', 'post', $args);
    
}

add_action('init', 'taxonomia_cidade');

// adiciona taxonomia de estilo
function taxonomia_estilo() {
    
    $nome = 'Estilo';
	
    $labels = array(
        'name' => $nome,
        'singular_name' => $nome,
        'add_new_item' => 'Adicionar novo ' . $nome,
        'edit_item' => 'Editar ' . $nome,
        'not_found' => 'Nenhum ' . $nome . ' encontrado'   
    );
	
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true
    );
	
    register_taxonomy('estilo', 'post', $args);
    
}

add_action('init', 'taxonomia_estilo');

// adiciona taxonomia de região
function taxonomia_regiao() {
    
    $nome = 'Região';
	
    $labels = array(
        'name' => $nome,
        'singular_name' => $nome,
        'add_new_item' => 'Adicionar nova ' . $nome,
        'edit_item' => 'Editar ' . $nome,
        'not_found' => 'Nenhuma ' . $nome . ' encontrada'   
    );
	
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true
    );
	
    register_taxonomy('regiao', 'post', $args);
    
}

add_action('init', 'taxonomia_regiao');

// adiciona taxonomia de Local
function taxonomia_local() {
    
    $nome = 'Local';
    $nomePlural = 'Locais';
    
    $labels = array(
        'name' => $nomePlural,
        'singular_name' => $nome,
        'add_new_item' => 'Adicionar novo ' . $nome,
        'edit_item' => 'Editar ' . $nome,
        'not_found' => 'Nenhum ' . $nome . ' encontrado'   
    );
	
    $args = array(
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_ui'                    => true,
        'show_in_quick_edit'         => false,
        'meta_box_cb'                => false
    );
	
    register_taxonomy('local', 'post', $args);
    
}

add_action('init', 'taxonomia_local');

?>