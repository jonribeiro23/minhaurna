<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
class Projetos_model extends CI_MODEL {
	public function __construct() {
    	parent::__construct();
	}

	public function listar_todos() {
		return $this->db->get('TB_Projeto')->result_array();
	}

	public function listar_pagina($pagina) {
		$this->db->limit(5, $pagina);
		return $this->db->get('TB_Projeto')->result_array();
	}

	public function get_projeto($id) {
		$this->db->where('cd_Projeto', $id);
		return $this->db->get('TB_Projeto')->row_array();
	}

	public function contar_projetos() {
		return $this->db->count_all('TB_Projeto');
	}
	
	public function inserir($projeto) {
	  return $this->db->insert('TB_Projeto', $projeto);
	}
		
	public function atualizar($projeto, $id) {
		$this->db->where('cd_Projeto', $id);
	  return $this->db->update('TB_Projeto', $projeto);
	}

	public function deletar($id) {
		$this->db->where('cd_Projeto', $id);
		return $this->db->delete('TB_Projeto');
	}
	
}