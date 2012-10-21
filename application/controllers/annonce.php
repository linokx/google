<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annonce extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('index.php/member');
		};
	}
	public function index()
	{
		$this->lister();
	}
	public function lister()
	{

		$this->load->helper('form');
		$this->session->set_flashdata('current_url',current_url());
		$this->load->model('M_Annonce');
		$data['annonces'] = $this->M_Annonce->lister();
		$data['subtitle'] = "Toutes les annonces";

		$data['vue'] = $this->load->view('lister',$data,true);
		
		$data['main_title'] = 'Liste des annonces';
		
		$this->load->view('layout',$data);
	}
	public function ajouter()
	{

		$this->load->model('M_Annonce');
		$this->load->helper('form');
		$url = $this->input->post('url');
		$data['annonces'] = $this->M_Annonce->lister();
		$data['id'] = $this->session->userdata('logged_in');
		$data['url']= 'http://'.$url;
		if($url != null):
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			//curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			// récupération du HTML
			$resultat = curl_exec($ch);
			// fermeture de la session cURL
			curl_close($ch);
			
			preg_match('#<title>(.+)</title>#isU', $resultat, $m, PREG_OFFSET_CAPTURE);
			$data['titre'] = (count($m) and count($m[1])) ? $m[1][0] : "Page sans titre";


			preg_match_all('#<\s*img[^>]*src\s*=\s*"(.*)"#isU',$resultat, $i, PREG_OFFSET_CAPTURE);
			$data['image'] = (count($i[1])) ? $i[1] : "Aucune image";


			preg_match('#<\s*meta\s*(name="description")?\s*content="\s*(.*)"\s*(name="description")?\s*>{1}#isU', $resultat,$t, PREG_OFFSET_CAPTURE );
			if(count($t)){
				preg_match_all('#^<.*content\s*=\s*"(.*)".*>$#isU',$t[0][0],$texte);
				$data['texte'] = (count($texte[1])) ? $texte[1][0]: "Aucune description de page";
			}
			else{
				$data['texte']= "Aucune desciption de page";
			}
			$data['BDimage'] = implode(';',$data['image'][0]);
			$this->M_Annonce->ajouter($data);
			//if(preg_match$data['texte'])
		endif;
		$dataLayout['main_title'] = "Ressource externe";
		$dataLayout['vue'] = $this->load->view('lister',$data,true);
		$this->load->view('layout',$dataLayout);
	}
}
?>