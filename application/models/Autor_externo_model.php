<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Modelo de Alunos
	*
	**/
class Autor_externo_model extends CI_MODEL {
	function __construct() {
    	parent::__construct();
	}
	
	public function inserir($dados){
	    return $this->db->insert('TB_Autor_Externo', $dados);
	}
	
	public function getUsuario($cpf){
		$this->db->select('*');
		$this->db->from('TB_Autor_Externo');
		$this->db->where('ds_Cpf', $cpf);
		return $this->db->get()->result();
	}
	
	public function getEmail($email){
		$this->db->select('ds_Email');
		$this->db->from('TB_Autor_Externo');
		$this->db->where('ds_Email', $email);
		return $this->db->get()->result();
	}
	
	public function logar($senha, $email){
		$this->db->select('*');
		$this->db->from('TB_Autor_Externo');
		$this->db->where('ds_Email', $email);
		$this->db->where('ds_Senha', $senha);
		return $this->db->get()->row(); 
	}

}