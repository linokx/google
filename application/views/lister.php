<div id="form">
<?php
		echo form_open('index.php/annonce/ajouter',array('method'=>'post'));
		echo form_label('http://','url');
		$urlInput = array(
					'name' => 'url',
					'id' => 'url'
					);
		echo form_input($urlInput);		
		echo form_submit('check','Analyser');
		echo form_close();
	?>

</div>
<?php
	if(isset($titre)):
		?>
	<div class="resultat">
		<h2><a title="Visiter la page de <?php echo $titre; ?>" href="<?php echo $url; ?>"><?php echo $titre; ?></a></h2>
		<?php
		if(is_string($image)){
			echo $image;
		}
		else
		{
			?>
			<div class="slider">
			<ul>
				<?php
			/*for($i=0; $i<$lenght; $i++):
				$img = $image[$i];
				$img = preg_replace('#^[^http]/*(.*)$#', $url.'/'.$img, $img);
				echo '<li><img src="'.$img.'" /></li>';
			endfor;*/
			foreach($image as $img):
				echo '<li><img src="'.$img.'"/></li>';
			endforeach;
			?>
		</ul>
		</div>
		<p><?php echo  $texte; ?></p>
			<?php
		}
	?>
	</div>
	<?php
	endif;
	?>

	<?php if(count($annonces)): ?>
		
		<?php
			foreach($annonces as $annonce):
				?>
				
				<div class="resultat">
					<h2><a title="Visiter la page de <?php echo $annonce->titre;?>" href="<?php echo $annonce->url; ?>">
						<?php echo $annonce->titre; ?>
					</a>
					</h2>
					<div class="slider">
						<?php
						if($annonce->photo != null):
						?>
						<ul>
							<?php
							$images = explode(';',$annonce->photo);
							foreach($images as $img):				
								echo '<li><img src="'.$img.'" /></li>';
							endforeach;
							?>
						</ul>
						<?php
						endif;
						?>
					</div>
					<p><?php echo  $annonce->resume; ?></p>
				</div>
				<?php
			endforeach;
		endif;
	?>