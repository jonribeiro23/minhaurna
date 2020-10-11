<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
class Areas_Linhas_model extends CI_MODEL {
	public function __construct() {
    	parent::__construct();
	}

	public function listarAreas() {
		return $this->db->get('TB_Area')->result_array();
	}
	
	public function listarLinhas($area = null) {
		
		if(!empty($area)) $this->db->where('cd_Area',$area);

		return $this->db->get('TB_Linha_Pesquisa')->result_array();
	}

	public function cadastrarUsuarioArea($cdUsuario, $cdArea) {
		$dados = [
			'cd_Area' => $cdArea,
			'cd_Usuario' => $cdUsuario
		];

		return $this->db->insert('TB_Usuario_Area', $dados);
	}

	public function cadastrarUsuarioLinha($cdUsuario, $cdLinha) {
		$dados = [
			'cd_Linha' => $cdLinha,
			'cd_Usuario' => $cdUsuario
		];

		return $this->db->insert('TB_Usuario_Linha', $dados);
	}

}