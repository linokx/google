<?php
		echo form_open('annonce/test',array('method'=>'post'));
		echo form_label('Url: http://','url');
		$urlInput = array(
					'name' => 'url',
					'id' => 'url'
					);
		echo form_input($urlInput);
		echo '<br />';
		
		echo form_submit('check','vérifier');
		echo form_close();
	
	if(isset($titre)):
		?>
		<h2><?php echo $titre; ?></h2>
		<?php
		if(is_string($texte)){
			echo $texte;
		}
		else
		{
			foreach($texte as $img):
				echo '<img src="http://lettrage-bekaert.eu/'.$img[0].'"/>';
			endforeach;
		}
	endif;
	?>