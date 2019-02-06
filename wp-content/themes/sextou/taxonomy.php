<?php
	// pega url e quebra os parametros para capturar taxonomia e term
	$url = $_SERVER['REQUEST_URI'];
	$filtrado = explode("/", $url, 4);
	$taxName = $filtrado[2];
	$taxTerm = $filtrado[3];

	$getTerms = get_term_by('slug', $taxTerm, $taxName)
?>
<?php get_header(); ?>

<?php get_template_part('components/section_logo') ?> 


<?php get_template_part('components/section_slider') ?> 


<?php get_template_part('components/section_menu') ?> 

<main role="main" class="container section">

	<div class="row">
		<div class="col-md-12 p-md-0">
			<p class="h1 text-center evento-title taxonomia-title">
				Sextou! - Eventos em <strong><?= $getTerms->name ?></strong>
			</p>
		</div>	
	</div>	

	<?php get_template_part('components/row_loop') ?> 

</main>
<!-- /.container -->

<?php get_footer(); ?>