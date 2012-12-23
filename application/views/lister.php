<a href="<?php echo site_url().'index.php/member/logout'; ?>" id="logout">Deconnexion</a>
<div id="form">
	<form method="post" action="index.php/annonce/ajouter">
	<?php $Purl = (isset($Surl))? $Surl : ''; ?>
		<label for="url">http://</label><input type="text" name="url" id="url" value="<?php echo $Purl; ?>"/><input type="submit" value="Analyser" />
		<img id="loader" style="display:none" height="40px" src="<?php echo site_url().IMG_DIR;?>/loader.gif" />
	</form>
</div>
<?php
	if(isset($titre)):
		?>
	<div class="apercu">
	<?php if($rep): ?>
		<h2><a title="Visiter la page de <?php echo $titre; ?>" href="<?php echo $url; ?>"><?php echo $titre; ?></a></h2>
		<h3>Cliquer sur l'image qui servira d'apercu <span style="font-size:12px">(L'image ne sera pas deformée lors de l'apercu)</span></h3>
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
				echo '<li ><img src="'.$img.'"/></li>';
			endforeach;
			?>
		</ul>
		</div>
		<h3>Vous pouvez modifier la description</h3>
		<?php 
		echo form_open('index.php/annonce/enregistrer',array('method'=>'post'));
		$fResumeTextarea = array(
					'name' => 'fResume',
					'value' => $resume
					); 
		echo form_textarea($fResumeTextarea);
		?>
			<?php
		}
		$fUrlInput = array(
					'name' => 'fUrl',
					'type' => 'hidden',
					'value' => $url
					);
		echo form_input($fUrlInput);		
		$fTitreInput = array(
					'name' => 'fTitre',
					'type' => 'hidden',
					'value' => $titre
					);
		echo form_input($fTitreInput);
		$fImageInput = array(
					'name' => 'fImage',
					'type' => 'hidden',
					'value' => ''
					);
		echo form_input($fImageInput);
		$fDBImageInput = array(
					'name' => 'fDBImage',
					'type' => 'hidden',
					'value' => $BDimage
					);
		echo form_input($fDBImageInput);		echo form_submit('check','Publier');
		echo form_close();
	else:
	?>
		<h2><a title="Visiter la page de <?php echo $titre; ?>" href="<?php echo $url; ?>"><?php echo $titre; ?></a></h2>
		<p class="erreur"><?php echo  $resume; ?></p>
	<?php
	endif;
	?>
	<a href="<?php echo site_url();?>" class="annuler">Annuler</a>
	</div>
	<?php
	endif;
	?>

	<?php if(count($annonces)): ?>
		
		<?php
			foreach($annonces as $annonce):
				?>
				<div class="bloc">
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
					<div class="lien">
						<span class="icon-cog-alt">Paramètre</span>
						<div>
							<a class="update icon-pencil" href="<?php echo 'annonce/modifier/'.$annonce->id; ?>">Modifier</a>
							<a class="delete icon-trash" href="<?php echo 'annonce/effacer/'.$annonce->id; ?>">Supprimer</a>
						</div>
					</div>
				</div>
				<?php
			endforeach;
		endif;
	?>