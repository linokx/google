<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annonce extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		};
	}
	public function index()
	{
		$this->lister();
	}
	public function lister()
	{
		$this->session->set_flashdata('current_url',current_url());
		$this->load->model('M_Annonce');
		$data['annonces'] = $this->M_Annonce->lister();
		$data['subtitle'] = "Toutes les annonces";
		$data['vue'] = $this->load->view('lister',$data,true);
		
		$data['main_title'] = 'Liste des annonces';
		
		$this->load->view('layout',$data);
	}
}
?>