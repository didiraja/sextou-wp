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