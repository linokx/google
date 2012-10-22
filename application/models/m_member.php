<?php
	class M_Member extends CI_Model
	{
		public function verifier($data)
		{
			$query = $this->db->get_where('membres', array('nom'=> $data['nom'], 'mdp'=> $data['mdp']));
			return $query->num_rows();
		}
		public function infos($data)
		{
			$this->db->select('*');
			$this->db->from('membres');
			$this->db->where('nom',$data);
			
			$query = $this->db->get();
			return $query->row();
		}
	}
?>