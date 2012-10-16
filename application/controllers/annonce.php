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
		$this->load->helper('form');
		$data['main_title'] = "Google+";
		$data['vue'] = $this->load->view('member_form','',true);
		$this->load->view('layout',$data);
	}
}
?>