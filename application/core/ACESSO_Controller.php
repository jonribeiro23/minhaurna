<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Controle_acesso extends CI_Controller {
	protected $usuario;
	
	public function __construct() {
		parent::__construct();
		
		$this->verificarSessao();
		
		$this->usuario = [
			'tipo'  => $this->session->userdata('nm_Tipo'),
			'id_usuario' => $this->session->userdata('cd_Usuario')
		];
	}
	
	public function verificarPermissoes($permissoes) {
		$tipos = $this->usuario['tipo'];
		$acesso = false;
		$master = '';
		$orientador = '';
		$avaliador = '';
		$acesso = false;
		foreach ($tipos as $t) {
			if($t == 'master'){
				$master = $t;
				// $this->session->userdata('master') = true;
			}

			if($t == 'orientador'){
				$orientador = $t;
				// $this->session->userdata('orientador') = true;
			}

			if($t == 'avaliador'){
				$avaliador = $t;
				// $this->session->userdata('avaliador') = true;
			}
		}
		
		
		if (in_array($master, $permissoes) || in_array($orientador, $permissoes) || in_array($avaliador, $permissoes)) {
			$acesso = true;
		}

		if (!$acesso) {
			$this->session->set_flashdata('alert-warning', 'Você não tem permissão para acessar a página anterior');
			return redirect('externo/login');
		}

		
	}
	
	public function verificarSessao() {
		if (!$this->session->userdata('logado'))
			return redirect('externo/login');
	}
}