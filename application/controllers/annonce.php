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

		$id = $this->session->userdata('logged_in')->membre_id;

		$this->load->helper('form');
		$this->session->set_flashdata('current_url',current_url());
		$this->load->model('M_Annonce');
		$data['annonces'] = $this->M_Annonce->lister($id);
		$data['subtitle'] = "Toutes les annonces";

		$data['vue'] = $this->load->view('lister',$data,true);
		
		$data['main_title'] = 'Liste des annonces';
		
		$this->load->view('layout',$data);
	}
	public function ajouter()
	{
		$id = $this->session->userdata('logged_in')->membre_id;

		$this->load->model('M_Annonce');
		$this->load->helper('form');
		$url = $this->input->post('url');
		$data['annonces'] = $this->M_Annonce->lister($id);
		$data['Surl'] = $url;
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
				if(!$resultat == false){
				
					
					$dom = new DOMDocument();
					@$dom->loadHTML($resultat);
					$nodes = $dom->getElementsByTagName('title');
					$data['titre'] = $nodes->item(0)->nodeValue;
					$data['titre'] = (empty($data['titre']))? $url : $data['titre'];


					//preg_match_all('#<\s*img[^>]*src\s*=\s*"(.*)"#isU',$resultat, $i, PREG_OFFSET_CAPTURE);
					
					$nodes = $dom->getElementsByTagName('img');
					$images = array();
					$imagesChoix = array();
					foreach($nodes as $node):
						$node_url = $node->getAttribute('src');
						$node_url = $this->rel2abs($url,$node_url);
						if(substr($node_url, 0, 4) == 'http'){
							$taille = getimagesize($node_url);
							if($taille[0] > 70)
							{
								array_push($images, $node_url);
							}
						}
					endforeach;
					$lenght = (sizeof($images)>=5)?5:sizeof($images);
					for($j=0; $j<$lenght; $j++):
						array_push($imagesChoix, $images[$j]);
					endfor;
					
					$images = $imagesChoix;
					$data['image'] = $images;
					$data['BDimage'] = implode(';',$images);
					
					$nodes = $dom->getElementsByTagName('meta');
					foreach($nodes as $node):
						if(strtolower($node->getAttribute('name')) == 'description')
						{
							$data['resume'] = $node->getAttribute('content');
						}
					endforeach;
					$data['resume'] = (empty($data['resume']))?"Aucune description de page" : $data['resume'];

					$data['rep'] = true;
				}
				else
				{
					$data['rep'] = false;
					$data['resume'] = "Vérifier que vous n'avez pas fait une erreur de frappe.";
					$data['titre'] = "Rien n'a été trouvé à l'adresse <a href='http://".$url."'>http://".$url."</a>";
				}
			//if(preg_match$data['texte'])
		endif;
		$dataLayout['main_title'] = "Ressource externe";
		$dataLayout['vue'] = $this->load->view('lister',$data,true);
		$this->load->view('layout',$dataLayout);
	}
	public function enregistrer(){
		$data['id'] = $this->session->userdata('logged_in')->membre_id;
		$data['date'] = date("Y/m/d H:i:s");
		$data['url'] = $this->input->post('fUrl');
		$data['titre'] = $this->input->post('fTitre');
		$data['resume'] = $this->input->post('fResume');
		$data['image'] = $this->input->post('fImage');
		$data['DBimage'] = $this->input->post('fDBImage');
		$this->load->model('M_Annonce');
		$this->M_Annonce->ajouter($data);
		redirect('index.php/annonce');
	}
	public function effacer(){
		$id = $this->uri->segment(3);
		$this->load->model('M_Annonce');
		$this->M_Annonce->supprimer($id);
	}
	function rel2abs ($pageURL, $link)
	{
	    if ( strstr($link, 'http://') !== false )
	        return $link;
	   
	    if ( $pageURL[strlen($pageURL) - 1] !== '/' )
	        $pageURL .= '/';
	   
	    if( $link[0] == '/' )
	        $link = substr($link, 1);
	   
	    return 'http://'.$pageURL.$link;
	}
	public function rel2ab($rel, $base)
	{
		$scheme = "http";
		$host = '';
		/* return if already absolute URL */
		if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
	   
		/* queries and anchors */
		if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;
	   
		/* parse base URL and convert to local variables:
		   $scheme, $host, $path */
		extract(parse_url($base));
	 
		/* remove non-directory element from path */
		$path = preg_replace('#/[^/]*$#', '', $path);
	 
		/* destroy path if relative url points to root */
		if ($rel[0] == '/') $path = '';
	   
		/* dirty absolute URL */
		$abs = "$host$path/$rel";
	 
		/* replace '//' or '/./' or '/foo/../' with '/' */
		$re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
		for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}
	   
		/* absolute URL is ready! */
		return $scheme.'://'.$abs;
	}
	public function modifier(){

		$this->load->model('M_Annonce');
		$this->load->helper('form');
		$id = $this->input->post('fId');

		if($id != null){

			$data['id'] = $id;
			$data['id_membre'] = $this->session->userdata('logged_in')->membre_id;
			$data['date'] = date("Y/m/d H:i:s");
			$data['url'] = $this->input->post('fUrl');
			$data['titre'] = $this->input->post('fTitre');
			$data['resume'] = $this->input->post('fResume');
			$data['photo'] = $this->input->post('fImage');
			$this->M_Annonce->modifier($data);
			redirect('index.php/annonce');
		}
		else{

			$id = $this->uri->segment(3);
			$data = $this->M_Annonce->voir($id);
			$dataLayout['main_title'] = "Modification de l'article";
			$dataLayout['vue'] = $this->load->view('modifier',$data,true);
			$this->load->view('layout',$dataLayout);
		}
	}
}
?>