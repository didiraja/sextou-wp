<?php get_header(); ?>
   
    <main role="main" class="container-fluid">

        <div class="row">
        	<div class="col-md-12 eventos-wrap">
        	
        		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        		
        			<div class="card card-evento">
						
						<div class="evento-thumb">
							<img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
						</div>
						
						<div class="card-body">
							<p class="h1 card-title"><?php the_title(); ?></p>
							
							<span style="color:red"><?php echo date("F", strtotime(get_field('data_evento'))); ?></span>
							
							<?php echo date("d",strtotime(get_field('data_evento'))); ?>
							
							<p class="h5 card-title">
								<?php the_field("local_evento"); ?>
							</p>
							
							<p class="card-text"><?= get_the_excerpt(); ?></p>
							<a href="#" class="btn btn-danger">Acessar página do evento</a>
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
        		
        		<!--<div class="card card-evento">
        		
        			<div class="evento-thumb">
						<img class="card-img-top" src="https://scontent.fsdu12-1.fna.fbcdn.net/v/t1.0-9/31895364_1354799981288612_1491686139545780224_o.jpg?_nc_cat=0&_nc_eui2=v1%3AAeEk9zN3cOMHYqeEvAs-C2qvj-BzriCvspnaJ5LlrGcIw60h6Jz7rw01v_IwxnuV6owoPHwoZSY-QhfpoBeJjPLEoXAEjm0lirW2KPcaKfZ2SA&oh=25719f88930eaa89974edf8571a3b12b&oe=5B88E6DD" alt="Card image cap">
					</div>
        		
					<div class="card-body">
					<h5 class="card-title">É HOJE ! KICKZ NA LAPA</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					<a href="#" class="btn btn-primary">Acessar página do evento</a>
				  </div>
				  
					<div class="card-footer">
					<a href="#" class="badge badge-primary">Rio</a> <a href="#" class="badge badge-success">Hip-Hop</a> <a href="#" class="badge badge-danger">Lapa</a>
				  </div>
				  
				</div>-->
			  
        	</div>
        </div>

    </main>
    <!-- /.container -->

<?php get_footer(); ?>