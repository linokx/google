<?php
	class M_Annonce extends CI_Model
	{
		public function lister()
		{
			$this->db->select('*');
			$this->db->from('annonces');
			
			$query = $this->db->get();
			return $query->result();
		}
		public function ajouter($data)
		{
			$info = array(
				'id_membre' => $data['id'],
				'date' => date("Y/m/d"),
				'url' => $data['url'],
				'titre' => $data['titre'],
				'resume' => $data['texte'],
				'photo' => $data['BDimage'],
				'statut' => 'non lu'
				);
			$this->db->insert('annonces', $info); 
		}
	}
?>