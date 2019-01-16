<?php get_header(); ?>

<section id="logo">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<a href="<?php echo home_url(); ?>">
					<img src="<?= get_template_directory_uri(); ?>/assets/img/sextou-logo.png" alt="Sextou!" class="img-fluid d-block mx-auto">
				</a>
			</div>
		</div>
	</div>
</section>

<section id="slider">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 p-0">
				<div class="main-slider">

					<?php
				
					$args = array('post_type' => 'slider');
						
					$loop = new WP_Query($args);
				
						if  ($loop->have_posts()) { ?>

					<?php
							while( $loop->have_posts() ) {
								$loop->the_post();
					?>
						<a href="<?php the_field('link_slider'); ?>" target="_blank">
							<img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid">
						</a>
						
					<?php
							}
						}
					?>
			</div>
		</div>
	</div>
</section>

<section id="menu d-md-none">
	<div class="container">

    <div class="row">
			<div class="col-md-12 menu-view">
				<button type="button" class="btn btn-secondary menu-view-btn">Menu</button>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 mx-auto">
				<ul class="lista-categoria text-center">
					<?php
						$args = array(
							'orderby' => 'id',
							'hide_empty' => false
						);
						$terms = get_terms('cidade', $args);
						foreach ( $terms as $term ) {
							echo '<li><a href="'.get_term_link($term->term_id).'" class="btn btn-secondary">' . $term->name . '</a></li>';
						}

						$terms = get_terms('estilo', $args);
						foreach ( $terms as $term ) {
							echo '<li><a href="'.get_term_link($term->term_id).'" class="btn btn-secondary">' . $term->name . '</a></li>';
						}
						$terms = get_terms('regiao', $args);
						foreach ( $terms as $term ) {
							echo '<li><a href="'.get_term_link($term->term_id).'" class="btn btn-secondary">' . $term->name . '</a></li>';
						}
					?>
					
					<li>
						<button class="btn btn-secondary abre-busca">
							<!-- img/magnifier.svg -->
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 485.2 485.2"><g fill="#FFF"><path d="M471.9 407.6L360.6 296.2a214.3 214.3 0 0 1-64.4 64.4l111.4 111.3a45.5 45.5 0 1 0 64.3-64.3zM364 182a182 182 0 1 0-364 0 182 182 0 0 0 364 0zM182 318.4A136.6 136.6 0 0 1 45.5 182c0-75.3 61.2-136.5 136.5-136.5 75.2 0 136.4 61.2 136.4 136.5 0 75.2-61.2 136.4-136.4 136.4z"/><path d="M75.8 182h30.3c0-41.8 34-75.9 75.9-75.9V75.8A106.3 106.3 0 0 0 75.8 182z"/></g></svg>
						</button>
					</li>
				</ul>
			</div>
		</div>

		<div class="row search-row">
			<div class="col-md-8 mx-auto">
				<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url(); ?>">
					<input type="text" value="" name="s" id="s" class="input-busca">
					<input type="submit" id="searchsubmit" class="btn btn-light" value="Pesquisar">
				</form>
			</div>
		</div>
	</div>
</section>

<main role="main" class="container section">

	<div class="row">
		<div class="col-md-12 eventos-wrap d-md-flex">
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="card-evento">

					<div class="card-header">

						<div class="evento-data-local">
							<p class="h1 evento-title">
								<?php echo mb_strimwidth(get_the_title(), 0, 18, '...'); ?>
							</p>
							
							<p class="texto-comum">
								<span class="card-data">
									<?php
										// get raw date
										$date = get_field('data_evento');
										// make date object
										//$date = new DateTime($date);
									?>
								<?= date_i18n('d F', strtotime($date)); ?>
								</span> • 
								<span class="card-local">
								<?php
									$local = get_field('local_evento');

									echo $local->name;
								?>
								</span>
							</p>
						</div>
						
						<img class="evento-thumb" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

					</div>

					<div class="cta-evento">

						<a href="<?php the_field('ingressos_online') ?>" target="_blank" class="btn btn-primary">
							Comprar ingresso
						</a>

						<a href="<?php the_field('link_evento') ?>" target="_blank" class="btn btn-outline-primary">
							Mais Informações
						</a>

					</div>

					<div class="card-footer">

					<ul class="link-tag">	

					<?php
						// Busca a taxonomia associada ao post
						$term_list = wp_get_post_terms($post->ID, 'cidade', array("fields" => "all"));
						
						// Escreve as taxonomias com link usando função de fora do loop 
						foreach($term_list as $term_single) {
							echo '<li><a href="' .get_term_link($term_single->term_id). '" class="link-tag-item">' .$term_single->name. '</a></li>';
						}

						$term_list = wp_get_post_terms($post->ID, 'estilo', array("fields" => "all"));
						foreach($term_list as $term_single) {
							echo '<li><a href="' .get_term_link($term_single->term_id). '" class="link-tag-item">' .$term_single->name. '</a></li>';
						}	

						$term_list = wp_get_post_terms($post->ID, 'regiao', array("fields" => "all"));
						foreach($term_list as $term_single) {
							echo '<li><a href="' .get_term_link($term_single->term_id). '" class="link-tag-item">' .$term_single->name. '</a></li>';
						}
					?>

					</ul>

					</div>

				</div>
			
			<?php endwhile; ?>

			<div class="btn-nav--wrap">

				<div class="nav-previous alignleft"><?php next_posts_link('<< Eventos antigos'); ?></div>
				<div class="nav-next alignright"><?php previous_posts_link('Novos Eventos >>'); ?></div>

			</div>

			<?php endif; ?>
			
		</div>
	</div>

</main>
<!-- /.container -->

<?php get_footer(); ?>