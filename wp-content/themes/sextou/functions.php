<?php

// adicionar imagem destacada
add_theme_support('post-thumbnails');

// renomeia post padrão 
function revcon_change_post_object() {
	$get_post_type = get_post_type_object('post');
	$labels = $get_post_type->labels;
	$labels->name = 'Eventos';
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
	$labels->menu_name = 'Eventos';
	$labels->name_admin_bar = 'Evento';
	//Change menu icon
	$get_post_type->menu_icon = 'dashicons-calendar-alt';
}

add_action( 'init', 'revcon_change_post_object' );

// cria post type Slider
function post_type_slider() {
    $nomeSingular = 'Slider';
    $nomePlural = 'Slider';
    $labels = array(
        'name' => $nomePlural,
        'singular_name' => $nomeSingular,
        'add_new_item' => 'Adicionar novo ' . $nomeSingular,
        'edit_item' => 'Editar ' . $nomeSingular,
        'not_found' => 'Nenhum ' . $nomeSingular . ' encontrado'
    );
    
    $supports = array(
        'title',
        'editor',
        'thumbnail'
    );
    $args = array (
        'labels' => $labels,
        'public' => true,
        'description' => 'Sliders da Home',
        'menu_icon' => 'dashicons-images-alt',
        'supports' => $supports,
        'menu_position' => 5
    );
    register_post_type('slider', $args);
};
add_action('init', 'post_type_slider');

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

// classes nos botões próximo e anterior
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn btn-secondary btn-nav"';
}

ini_set( 'mysql.trace_mode', 0 );

function mytheme_infinite_scroll_init() {
  add_theme_support(‘infinite-scroll’, array(
      ‘container’ => ‘content’,
      ‘render’ => ‘mytheme_infinite_scroll_render’,
      ‘footer’ => ‘wrapper’,
      )
  );
}

add_action( ‘init’, ‘mytheme_infinite_scroll_init’ );

function mytheme_infinite_scroll_render() {
  get_template_part( ‘loop’ );
}

// Post Navi
	function get_archive_nav() {

			$args = array(
				'post_type' 		=> 'post',
				'posts_per_page'	=> -1
			);

			$posts = new WP_Query( $args );
			$posts->max_num_pages = ceil( ( $posts->found_posts / 10 ) );

		
		if( $posts->max_num_pages <= 1 )
			return;

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = ceil( $posts->max_num_pages );


		if ( $paged >= 1 )
			$links[] = $paged;


		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		$pathUrl = $_SERVER['REQUEST_URI'];
		if( strpos( $pathUrl, '/page/' ) === false ){
			$fullUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}page/";
		}else{
			$fullUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
			$fullUrl = explode( '/page/', $fullUrl );
			$fullUrl = $fullUrl[0] . '/page/';
		}

		echo '<div class="navigation"><ul>' . "\n";


		if ( $paged >= 2 )
			echo '<li class="first"><a href="'. $fullUrl . ( $paged - 1 ) .'"><</a></li>';

		/**	Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';

			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( ! in_array( 2, $links ) )
				echo '<li class="nope first"><a href="javascript:void(0);">…</a></li>';
		}

		/**	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/**	Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) )
				echo '<li class="nope last"><a href="javascript:void(0);">…</a></li>' . "\n";

			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/**	Next Post Link */
		if ( $paged >= 1 && $paged < $max )
			echo '<li class="next"><a href="'. $fullUrl . ( $paged + 1 ) .'">></a></li>';

		echo '</ul></div>' . "\n";

	}

?>
