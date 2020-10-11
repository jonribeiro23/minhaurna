<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Login_model', 'login');
		$this->load->library('Criptografar');
	}

	public function index() {
		$this->load->view('aluno-externo/pagina-inicial');
	}

	public function login() {
		$this->load->view('aluno-externo/login/login');
	}

	public function autenticar() {
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
		$dados = $this->login->getUsuario($email, $this->criptografar->cripto($senha));
		$tipo = [];
		$nivel = $this->login->getNivel($dados[0]['cd_Usuario']);
		foreach ($nivel as $n) {
			$x = $this->login->getNomeNivel($n['cd_Nivel']);
			array_push($tipo, $x[0]['nm_Nivel']);
		}
		echo "<pre>";

		if ($dados) {
			$sessao = [
				'cd_Usuario'	=> $dados[0]['cd_Usuario'],
				'nm_Usuario'	=> $dados[0]['nm_Usuario'],
				'nm_Tipo'		=> $tipo,
				'logado'		=> TRUE,
				'master' 		=> false,
				'orientador' 	=> false,
				'avaliador' 	=> false
			];

			foreach ($tipo as $t) {
				if ($t == 'master') {
					$sessao['master'] = true;
				}

				if ($t == 'orientador') {
					$sessao['orientador'] = true;
				}

				if ($t == 'avaliador') {
					$sessao['avaliador'] = true;
				}
			}

			// var_dump($sessao);
			// die();

			$this->session->set_userdata($sessao);
			redirect(base_url('projetos'));

		} else {
			echo "erro";
		}
		
	}	
}
