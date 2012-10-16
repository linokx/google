<div id="member">
	<h2>Connexion à votre compte</h2>
	<?php
		echo form_open('member/login',array('method'=>'post'));
		echo form_label('adresse email','email');
		$emailInput = array(
					'name' => 'email',
					'id' => 'email'
					);
		echo form_input($emailInput);
		echo '<br />';
		echo form_label('mot de passe','mpd');
		$mdpInput = array(
					'name' => 'mdp',
					'id' => 'mdp'
					);
		echo form_password($mdpInput);
		echo '<br />';
		echo form_submit('check','vérifier');
		echo form_close();
	?>
</div>