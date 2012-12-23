<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	public function index()
	{

		if($this->session->userdata('logged_in')){
			redirect('index.php/annonce');
		}
		$this->load->helper('form');
		$data['main_title'] = "Google+";
		$data['vue'] = $this->load->view('member_form','',true);
		$this->load->view('layout',$data);
	}
	public function login()
	{
		if($this->session->userdata('logged_in')){
			redirect('index.php/annonce');
		}
		$this->load->model('M_Member');
		$data['mdp'] = $this->input->post('mdp');
		$data['nom'] = $this->input->post('nom');
		if($this->M_Member->verifier($data)){
			$info = $this->M_Member->infos($data['nom']);
			$this->session->set_userdata('logged_in',$info);
			redirect('index.php/annonce');
		}
		else
		{
			redirect('error/mauvais_identifiant');
		}
	}
	public function logout(){
		$this->session->unset_userdata('logged_in');
		redirect('index.php/member');
	}
}
?>