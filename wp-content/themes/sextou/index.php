<?php get_header(); ?>

	<section id="logo">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<img src="<?= get_template_directory_uri(); ?>/assets/img/sextou-logo.png" alt="Sextou!" class="img-fluid d-block mx-auto">
				</div>
			</div>
		</div>
	</section>

	<section id="slider">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 p-md-0">
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

						<a href="#" target="_blank">
							<img src="http://via.placeholder.com/2000x500/1B9CFC/000000?text=Ultimo+Slide" class="img-fluid">
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
								echo '<li><a href="'.get_term_link($term->term_id).'" target="_blank">' . $term->name . '</a></li>';
							}

							$terms = get_terms('estilo', $args);
							foreach ( $terms as $term ) {
								echo '<li><a href="'.get_term_link($term->term_id).'" target="_blank">' . $term->name . '</a></li>';
							}
							$terms = get_terms('regiao', $args);
							foreach ( $terms as $term ) {
								echo '<li><a href="'.get_term_link($term->term_id).'" target="_blank">' . $term->name . '</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>

    <main role="main" class="container section">

        <div class="row">
        	<div class="col-md-12 eventos-wrap d-md-flex">
        	
        		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        		
        			<div class="card card-evento">
						
						<div class="evento-thumb">
							<img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
						</div>
						
						<div class="card-body">
							<p class="h1 card-title">
								<?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?>
							</p>
							
							<div class="data-local-info d-md-flex">
								<div class="data-evento">
									<?php
										// get raw date
										$date = get_field('data_evento');
										// make date object
										//$date = new DateTime($date);
									?>

									<p class="mes-evento">
										<?= date_i18n('M', strtotime($date)); ?>
									</p>
									<p class="dia-evento">
									<?= date_i18n('d', strtotime($date)); ?>
									</p>

										
								</div>	

								<div class="h5 local-evento">
									<?php
										$local = get_field('local_evento');

										echo $local->name;
									?>
								</div>
							</div>
							
							<p class="card-text resumo-evento">
								<?= mb_strimwidth( get_the_excerpt(), 0, 98, '...'); ?>
							</p>

							<div class="cta-evento">

								<a href="#" target="_blank" class="btn btn-primary"><i class="fas fa-ticket-alt"></i> Comprar ingresso</a>

								<a href="<?php the_field('link_evento') ?>" target="_blank" class="btn btn-outline-primary"><i class="fab fa-facebook-square"></i> Mais Informações</a>

							</div>
						</div>
						
						<div class="card-footer">

							<?php
								// Busca a taxonomia associada ao post
								$term_list = wp_get_post_terms($post->ID, 'cidade', array("fields" => "all"));
								
								// Escreve as taxonomias com link usando função de fora do loop 
								foreach($term_list as $term_single) {
									echo '<a href="' .get_term_link($term_single->term_id). '" class="badge badge-primary">' .$term_single->name. '</a>';
								}
							
								$term_list = wp_get_post_terms($post->ID, 'estilo', array("fields" => "all"));
								foreach($term_list as $term_single) {
									echo '<a href="' .get_term_link($term_single->term_id). '" class="badge badge-success">' .$term_single->name. '</a>';
								}	
							
								$term_list = wp_get_post_terms($post->ID, 'regiao', array("fields" => "all"));
								foreach($term_list as $term_single) {
									echo '<a href="' .get_term_link($term_single->term_id). '" class="badge badge-danger">' .$term_single->name. '</a>';
								}
							?>
							
						 </div>
						
						</div>
        		
        		<?php endwhile; ?>
				<?php endif; ?>
			  
        	</div>
        </div>

    </main>
    <!-- /.container -->

<?php get_footer(); ?>