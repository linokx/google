<?php
	class M_Member extends CI_Model
	{
		public function verifier($data)
		{
			$query = $this->db->get_where('membre', array('login'=> $data['nom'], 'mdp'=> sha1($data['mdp'])));
			return $query->num_rows();
		}
		public function infos($data)
		{
			$this->db->select('*');
			$this->db->from('membre');
			$this->db->where('login',$data);
			
			$query = $this->db->get();
			return $query->row();
		}
	}
?>