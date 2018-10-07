<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

<section id="logo">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<a href="/">
					<img src="<?= get_template_directory_uri(); ?>/assets/img/sextou-logo.png" alt="Sextou!" class="img-fluid d-block mx-auto">
				</a>
			</div>
		</div>
	</div>
</section>

<section id="menu">
	<div class="container">
		<div class="row">
			<div class="col-md-10 mx-auto">
				<ul class="lista-categoria text-center">
					<?php
						$args = array(
							'orderby' => 'id',
							'hide_empty' => false
						);
						$terms = get_terms('cidade', $args);
						foreach ( $terms as $term ) {
							echo '<li><a href="'.get_term_link($term->term_id).'">' . $term->name . '</a></li>';
						}

						$terms = get_terms('estilo', $args);
						foreach ( $terms as $term ) {
							echo '<li><a href="'.get_term_link($term->term_id).'">' . $term->name . '</a></li>';
						}
						$terms = get_terms('regiao', $args);
						foreach ( $terms as $term ) {
							echo '<li><a href="'.get_term_link($term->term_id).'">' . $term->name . '</a></li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</section>

<main role="main" class="container section">

	<div class="row">
		<div class="col-md-12 eventos-wrap">
		
			<p class="h1">Resultados da Busca</p>

			<?php get_search_form(); ?>
			
		</div>
	</div>

</main>
<!-- /.container -->

<?php get_footer(); ?>