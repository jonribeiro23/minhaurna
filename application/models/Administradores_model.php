
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Modelo de Alunos
	*
	**/
class Administradores_model extends CI_MODEL {
	function __construct() {
		parent::__construct();
	}
	
	public function inserirUsuario($dados){
		return $this->db->insert('TB_Usuario', $dados);
	}
	
	public function inserirArea($dados){
		return $this->db->insert('TB_Usuario_Area',$dados);
	}

	public function inserirLinha($dados){
		return $this->db->insert('TB_Usuario_Linha',$dados);
	}

	public function inserirNivel($dados){
		return $this->db->insert('TB_Usuario_Nivel',$dados);    
	}

	public function getIdUsuario($cpf){
		$this->db->select('cd_Usuario');
		$this->db->from('TB_Usuario');
		$this->db->where('ds_Cpf', $cpf);
		return $this->db->get()->result_array();
	}

	public function getIdNivel($nivel){
		$this->db->select('cd_Nivel');
		$this->db->from('TB_Nivel');
		$this->db->where('nm_Nivel', $nivel);
		return $this->db->get()->result_array();
	}
	
	public function listagemtudo(){
		//testar
	    $this->db->select('*');
		$this->db->from('TB_Usuario');
		
	    return $this->db->get()->result_array();
	    
	}
	
	public function get_usuario($id) {
		$this->db->where('cd_Usuario', $id);
		return $this->db->get('TB_Usuario')->row_array();
	}

	public function ContarLinhas(){
		return $this->db->count_all('TB_Autor');
	}

	public function getAdministrador($sort='cd_Usuario', $order='ASC', $limit=null, $offset=null){
		$this->db->order_by($sort, $order);

		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get('TB_Usuario');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return null;
		}
	}
	public function delete($dados) {
		return $this->db
			->where('nm_USuario', $dados["nm_Usuario"])
			->delete('TB_Usuario');
	}
	public function atualiza($projeto, $id) {
      $this->db->where('cd_Projeto', $id);
	  return $this->db->update('TB_Projeto', $projeto);
	}
}
