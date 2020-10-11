<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
class Login_model extends CI_MODEL {
	public function __construct() {
    	parent::__construct();
	}

	public function getUsuario($email, $senha){
		$this->db->select('*');
		$this->db->where('ds_Email', $email);
		$this->db->where('ds_Senha', $senha);
		return $this->db->get('TB_Usuario')->result_array();
	}

	public function getNivel($id){
		$this->db->select('cd_Nivel');
		$this->db->where('cd_Usuario', $id);
		return $this->db->get('TB_Usuario_Nivel')->result_array();	
	}

	public function getNomeNivel($id){
		$this->db->select('nm_Nivel');
		$this->db->where('cd_Nivel', $id);
		return $this->db->get('TB_Nivel')->result_array();	
	}
}