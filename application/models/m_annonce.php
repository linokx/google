<?php
	class M_Annonce extends CI_Model
	{
		public function lister($id)
		{
			$this->db->select('*');
			$this->db->from('annonces');
			$this->db->where('id_membre',$id);
			$this->db->order_by("date", "desc");
			
			$query = $this->db->get();
			return $query->result();
		}
		public function ajouter($data)
		{
			$info = array(
				'id_membre' => $data['id'],
				'date' => $data['date'],
				'maj' => $data['date'],
				'url' => $data['url'],
				'titre' => $data['titre'],
				'resume' => $data['resume'],
				'photo' => $data['image'],
				'DBimage' => $data['DBimage'],
				'statut' => 'non_lu'
				);
			$this->db->insert('annonces', $info); 
		}
		public function supprimer($id){
			$this->db->delete('annonces',array('id' => $id));
			if($this->input->is_ajax_request()){
				echo 'Suppression en cours...';
			}
			else
			{
				echo 'Suppression en cours...';
			}

		}
		public function voir($id){
			$this->db->select('*');
			$this->db->from('annonces');
			$this->db->where('id',$id);

			$query = $this->db->get();
			return $query->row();
		}
		public function modifier($infos){
			$data = array(
            	'titre' => $infos['titre'],
           		'resume' => $infos['resume'],
           		'maj' => $infos['date'],
           		'photo' => $infos['photo']
            );

			$this->db->where('id',$infos['id']);
			$this->db->where('id_membre',$infos['id_membre']);
			$this->db->update('annonces', $data);
		}
	}
?>