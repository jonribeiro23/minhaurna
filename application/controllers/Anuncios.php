<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anuncios extends CI_Controller {
	public function index() {
		// echo "Página sobre como anunciar.";
		$this->load->view('template.php', ['view' => 'anuncios/anuncios', 'data' => []]);
	}

}
