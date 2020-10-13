<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulador extends CI_Controller {
	public function index() {
		$this->load->view('template.php', ['view' => 'simulador/simulador', 'data' => []]);
	}

	public function votacao() {
		$this->load->view('template.php', ['view' => 'simulador/votacao', 'data' => []]);
	}

	public function teste2() {
		$this->load->view('template.php', ['view' => 'simulador/teste2', 'data' => []]);
	}
}
