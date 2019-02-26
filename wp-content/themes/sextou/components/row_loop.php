<div class="row">
		<div class="col-md-12 eventos-wrap d-md-flex">
			
			<!-- Loop Principal -->
      <?php
				$today = date("Y-m-d");
				$search_query = $_GET['s'];
        $args = (array(
					's' => $search_query,
          'meta_key' => 'data_evento',
          'orderby' => 'meta_value',
					'order' => 'ASC',
          'meta_query' => array(
            array(
              'key' => 'data_evento',
              'value' => strval($today),
              'type' => 'date',
              'compare' => '>='
            )
					)
				));

				$the_query = new WP_Query( $args );
				
				if ( $the_query->have_posts() ) { while ( $the_query->have_posts() ) { $the_query->the_post();
			?>

				<div class="card-evento">

					<div class="card-header">

						<div class="arc-wrap">
							<img class="evento-thumb" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
						</div>

						<div class="evento-data-local">
							<p class="h1 evento-title">
								<?php echo mb_strimwidth(get_the_title(), 0, 20, '...'); ?>
							</p>
							
							<p class="texto-comum">
								<span class="card-data">
									<?php
										$date = get_field('data_evento');
										echo date_i18n('d F', strtotime($date));
									?>
								</span> • 
								<span class="card-local">
									<?php
										$local = get_field('local_evento');
										echo $local->name;
									?>
								</span>
							</p>
						</div>						

					</div>

					<div class="cta-evento">

						<a href="<?php $the_query->the_field('ingressos_online') ?>" target="_blank" class="btn btn-primary">
							Comprar ingresso
						</a>

						<a href="<?php $the_query->the_field('link_evento') ?>" target="_blank" class="btn btn-outline-primary">
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

						$term_list = wp_get_post_terms($post->ID, 'regiao', array("fields" => "all"));
						foreach($term_list as $term_single) {
							echo '<li><a href="' .get_term_link($term_single->term_id). '" class="link-tag-item">' .$term_single->name. '</a></li>';
						}

						$term_list = wp_get_post_terms($post->ID, 'estilo', array("fields" => "all"));
						foreach($term_list as $term_single) {
							echo '<li><a href="' .get_term_link($term_single->term_id). '" class="link-tag-item">' .$term_single->name. '</a></li>';
						}	

					?>

					</ul>

					</div>

				</div>
			
				<?php } // end while ?>

			<div class="btn-nav--wrap">

				<div class="nav-previous alignleft">
					<?php next_posts_link('<svg xmlns="http://www.w3.org/2000/svg" viewBox="320 -369.4 1542 1538.9"><path d="M1107 445c-5.3-6-9.7-12.3-13-19v710c0 17.3-4.3 28-13 32s-19.3-.3-32-13L339 445c-12.7-12.7-19-27.7-19-45s6.3-32.3 19-45l710-710c12.7-12.7 23.3-17 32-13s13 14.7 13 32v710a64 64 0 0 1 13-19l710-710c12.7-12.7 23.3-17 32-13s13 14.7 13 32v1472c0 17.3-4.3 28-13 32s-19.3-.3-32-13l-710-710z"/></svg> Eventos antigos'); ?>
				</div>
				<div class="nav-next alignright">
					<?php previous_posts_link('Novos Eventos <svg xmlns="http://www.w3.org/2000/svg" viewBox="320 -369.4 1542 1538.9"><path d="M365 1155c-12.7 12.7-23.3 17-32 13s-13-14.7-13-32V-336c0-17.3 4.3-28 13-32s19.3.3 32 13l710 710a64 64 0 0 1 13 19v-710c0-17.3 4.3-28 13-32s19.3.3 32 13l710 710c12.7 12.7 19 27.7 19 45s-6.3 32.3-19 45l-710 710c-12.7 12.7-23.3 17-32 13s-13-14.7-13-32V426c-3.3 6.7-7.7 13-13 19l-710 710z"/></svg>'); ?>
				</div>

			</div>

			<?php
				} // end inf
			
				// Reset Post Data
				// wp_reset_postdata();
			?>
			
		</div>
	</div>