<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	public function index()
	{
		$data['vue'] = $this->load->view('member_form');
		$this->load->view('layout');
	}
}