<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Modelo de Alunos
	*
	**/
class Autor_model extends CI_MODEL {
	protected $auxiliar;
	function __construct() {
		parent::__construct();
		$this->auxiliar = $this->load->database('auxiliar', TRUE);
	}

	public function getAutores($sort='cd_Autor', $order='ASC', $limit=null, $offset=null){
		$this->db->order_by($sort, $order);

		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get('TB_Autor');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return null;
		}
	}

	public function getAutor($id){
		$this->db->select('*');
		$this->db->where('cd_Autor', $id);
		return $this->db->get('TB_Autor')->result_array();
	}

	public function getIdAutores($id_orientador){
		$this->db->select('cd_Autor');
		$this->db->where('cd_Orientador', $id_orientador);
		return $this->db->get('TB_Orientador_Autor')->result_array();
	}

	public function getAluno($cpf){
		$this->auxiliar->select('nm_Usuario, ds_Email');
		$this->auxiliar->from('TB_SE_Usuario');
		$this->auxiliar->where('cd_Cpf', $cpf);
		return $this->auxiliar->get()->result();
	}

	public function verifica($cpf){
		$this->db->select('nm_Autor');
		$this->db->from('TB_Autor');
		$this->db->where('ds_Cpf', $cpf);
		return $this->db->get()->result();
	}

	public function getId($cpf){
		$this->db->select('cd_Autor');
		$this->db->from('TB_Autor');
		$this->db->where('ds_Cpf', $cpf);
		return $this->db->get()->result();	
	}

	public function salvar($dados){
		return $this->db->insert('TB_Autor', $dados);
	}

	public function getCursos(){
		$this->auxiliar->select('nm_Curso');
		return $this->auxiliar->get('TB_Curso')->result_array();
	}

	public function countAll(){
		return $this->db->count_all('TB_Autor');
	}

	public function relacaoOrientadorAutor($dados){
		return $this->db->insert('TB_Orientador_Autor', $dados);
	}

	public function editar($id, $dados){
		$this->db->where('cd_Autor', $id);
		return $this->db->update('TB_Autor', $dados);
	}

	public function deletar($id){
		$tables = array('TB_Orientador_Autor', 'TB_Autor');
		$this->db->where('cd_Autor', $id);
		return $this->db->delete($tables);
	}

}