<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	public function index()
	{

		$this->load->helper('form');
		$data['main_title'] = "Google+";
		$data['vue'] = $this->load->view('member_form','',true);
		$this->load->view('layout',$data);
	}
	public function login()
	{
		$this->load->model('M_Member');
		$data['mdp'] = $this->input->post('mdp');
		$data['nom'] = $this->input->post('nom');
		if($this->M_Member->verifier($data)){
			$this->session->set_userdata('logged_in',true);
			redirect('welcome');
		}
		else
		{
			redirect('error/mauvais_identifiant');
		}
	}
}
?>