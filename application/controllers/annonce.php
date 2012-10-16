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
	public function test()
	{

		$this->load->helper('form');
		$url = $this->input->post('url');
		$data['url']= $url;
		if($url != null):
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://'.$url);
			//curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			// récupération de l'URL et affichage sur le naviguateur
			

			$resultat = curl_exec($ch);
			// fermeture de la session cURL
			curl_close($ch);
			
			/*if(preg_match('#<title>(.+)</title>#isU', $resultat, $m, PREG_OFFSET_CAPTURE)){

				$data['titre'] = $m[1][0];
			}
			else
			{
				$data['titre'] = "vide";
			}*/
			preg_match('#<title>(.+)</title>#isU', $resultat, $m, PREG_OFFSET_CAPTURE);
			$data['titre'] = (count($m[1])) ? $m[1][0] : "Page sans titre";
			preg_match_all('#<\s*img[^>]*src\s*=\s*"(.*)"#isU',$resultat, $i, PREG_OFFSET_CAPTURE);
			//preg_match_all('#<img(.+)>#isU',$resultat, $i, PREG_OFFSET_CAPTURE);
			$data['texte'] = (count($i[1])) ? $i[1] : "Aucune image";
			//if(preg_match$data['texte'])
		endif;
		$dataLayout['main_title'] = "Ressource externe";
		$dataLayout['vue'] = $this->load->view('annonce',$data,true);
		$this->load->view('layout',$dataLayout);
	}
}
?>