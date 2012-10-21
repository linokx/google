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
		var_dump($image);
		?>
	<div class="resultat">
		<h2><a title="<?php echo $url; ?>" href="<?php echo $url; ?>"><?php echo $titre; ?></a></h2>
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
			for($i=0; $i<=3 and $i<=sizeof($image[0]); $i++):
				$img = $image[$i];
				$img[0] = preg_replace('#^[^http]/*(.*)$#', $url.'/'.$img[0], $img[0]);
				echo '<li><img src="'.$img[0].'" /></li>';
			endfor;
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
					<h2>
						<?php echo $annonce->titre; ?>
					</h2>
					<div class="slider">
						<?php
						if($annonce->photo != null):
						?>
						<ul>
							<?php
							$images = explode(';',$annonce->photo);
							foreach($images as $img):				
								$img = preg_replace('#^[^http]/*(.*)$#', $annonce->url.'/'.$img, $img);
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