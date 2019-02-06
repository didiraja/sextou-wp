<section id="menu d-md-none">
	<div class="container">

		<div class="row">
			<div class="col-md-12 menu-view p-md-0">
				<button type="button" class="btn btn-secondary menu-view-btn">
				<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M4 10h24a2 2 0 0 0 0-4H4a2 2 0 0 0 0 4zm24 4H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4zm0 8H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4z"/></svg> Menu
				</button>				
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