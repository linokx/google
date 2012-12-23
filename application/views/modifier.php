<a href="<?php echo site_url().'index.php/member/logout'; ?>" id="logout">Deconnexion</a>
	<div class="apercu">
		<h2><a title="Visiter la page de <?php echo $titre; ?>" href="<?php echo $url; ?>"><?php echo $titre; ?></a></h2>
		<h3>Cliquer sur l'image qui servira d'apercu <span style="font-size:12px">(L'image ne sera pas deformée lors de l'apercu)</span></h3>
		
			<div class="slider">
			<ul>
				<?php
			/*for($i=0; $i<$lenght; $i++):
				$img = $image[$i];
				$img = preg_replace('#^[^http]/*(.*)$#', $url.'/'.$img, $img);
				echo '<li><img src="'.$img.'" /></li>';
			endfor;*/
			$images = explode(';',$DBimage);
			foreach($images as $img):
				$class = ($img == $photo) ? "class='choix'" : '';
				echo '<li '.$class.' ><img src="'.$img.'"/></li>';
			endforeach;
			?>
		</ul>
		</div>
		<h3>Vous pouvez modifier la description</h3>
		<?php 
		echo form_open('index.php/annonce/modifier',array('method'=>'post'));
		$fResumeTextarea = array(
					'name' => 'fResume',
					'value' => $resume
					); 
		echo form_textarea($fResumeTextarea);
		$fIdInput = array(
					'name' => 'fId',
					'type' => 'hidden',
					'value' => $id
					);
		echo form_input($fIdInput);
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
					'value' => $photo
					);
		echo form_input($fImageInput);
		$fDBImageInput = array(
					'name' => 'fDBImage',
					'type' => 'hidden',
					'value' => $DBimage
					);
		echo form_input($fDBImageInput);
		echo form_submit('check','Enregistrer les modifications');
		echo form_close();?>
	<a href="<?php echo site_url();?>" class="annuler">Annuler</a>
	</div>