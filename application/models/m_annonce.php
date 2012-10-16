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
	}
?>