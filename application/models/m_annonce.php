<?php
	class M_Annonce extends CI_Model
	{
		public function lister()
		{
			$this->db->select('*');
			$this->db->from('annonces');
			$this->db->order_by("date", "desc"); 
			
			$query = $this->db->get();
			return $query->result();
		}
		public function ajouter($data)
		{
			$info = array(
				'id_membre' => $data['id'],
				'date' => date("Y/m/d H:i:s"),
				'url' => $data['url'],
				'titre' => $data['titre'],
				'resume' => $data['resume'],
				'photo' => $data['DBimage'],
				'statut' => 'non lu'
				);
			$this->db->insert('annonces', $info); 
		}
		public function supprimer($id){
			$this->db->delete('annonces',array('id' => $id));
			if($this->input->is_ajax_request()){
				echo 'Lien supprimé';
			}
			else
			{
				$data['vue']='ok';
				$this->load->view('ok');
			}

		}
	}
?>