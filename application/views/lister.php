<div id="container">

	<div id="profs">
	<?php if(count($annonces)): ?>
	<h2><?php echo $subtitle; ?></h2>
		<ol>
		<?php
			foreach($annonces as $annonce):
				?>
				<li class="annonce nonlu">
					<h3>
						<?php echo $annonce->titre; ?>
					</h3>
					<div class="image">
						
						
					</div>
				</li>
				<?php
			endforeach;
		?>
		</ol>
		<?php
		endif;
	?>
	</div>
</div>