<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Modelo de Usuarios
	*
	**/
class Usuario_model extends CI_MODEL {
	function __construct() {
    	parent::__construct();
	}


	//Pegar Informações nas tabelas

	//Pegar id do nivel Usuario
	public function getIdNivel($nivel){
		$this->db->select('cd_Nivel');
		$this->db->from('TB_Nivel');
		$this->db->where('nm_Nivel', $nivel);
		return $this->db->get()->result_array();
	}

	//Pegar id do Usuario
	public function getIdUsuario($cpf){
		$this->db->select('cd_Usuario');
		$this->db->from('TB_Usuario');
		$this->db->where('ds_Cpf', $cpf);
		return $this->db->get()->result_array();
	}




	//Pega o usuario de acordo nivel de acesso
	public function getUsuario($sort='cd_Usuario', $order='ASC', $limit=null, $offset=null,$id){

		
		$this->db->order_by($sort, $order);
		
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$query = 
			$this->db->Select('TB_Usuario.*, TB_Usuario_Nivel.*, TB_Nivel.*');
			$this->db->join('TB_Usuario_Nivel', 'TB_Usuario.cd_Usuario = TB_Usuario_Nivel.cd_Usuario');
			$this->db->join('TB_Nivel', 'TB_Usuario_Nivel.cd_Nivel = TB_Nivel.cd_Nivel');
			$this->db->from('TB_Usuario')->where('TB_Nivel.nm_Nivel',$id);
			$query = $this->db->get()->result_array();

			return $query;
	}

	//Fim de pegar informações

	//Inserção

	//Inserir usuario
	public function inserirProfessor($dados){
		return $this->db->insert('TB_Usuario', $dados);
	}
	
	//inserir area de pesquisa
	public function inserirArea($dados){
		return $this->db->insert('TB_Usuario_Area',$dados);
	}

	//inserir a linha de pesquisa
	public function inserirLinha($dados){
		return $this->db->insert('TB_Usuario_Linha',$dados);
	}


	 //inserir o nivel de acesso
	public function inserirNivel($dados){
		return $this->db->insert('TB_Usuario_Nivel',$dados);    
	}
	
	//Fim Inserção


	//Contador de Linhas de acordo com tipo de acesso
	public function ContarLinhas($id){
		return $this->db->from('TB_Usuario_Nivel')->where('cd_Nivel', $id)->count_all_results();
	}

	

	//Funções de Deletar
	public function delete($dados) {
		return $this->db
			->where('cd_Usuario', $dados)
			->delete('TB_Usuario');
	}

	public function deleteUsuario_Nivel($dados) {
		return $this->db
			->where('cd_Usuario', $dados)
			->delete('TB_Usuario_Nivel');
	}

	public function deleteUsuario_Linha($dados) {
		return $this->db
			->where('cd_Usuario', $dados)
			->delete('TB_Usuario_Linha');  
	}

	public function deleteUsuario_Area($dados) {
		return $this->db
			->where('cd_Usuario', $dados)
			->delete('TB_Usuario_Area');
	}
	//Fim de Deletar


	//Buscadores de informação para editar e devolve em um array
	public function buscaracesso($id){
		return
		 $this->db->select('TB_Nivel.nm_Nivel')
		->join('TB_Usuario_Nivel', 'TB_Usuario_Nivel.cd_Nivel = TB_Nivel.cd_Nivel','inner')
		->join('TB_Usuario', 'TB_Usuario.cd_Usuario = TB_Usuario_Nivel.cd_Usuario','inner')
		->where('TB_Usuario.cd_Usuario', $id)
		->get('TB_Nivel')->result()
		;
	 
	}	


	public function buscarArea($id){
		$this->db->select("tbua.cd_Area, tba.nm_Area");
		$this->db->from("TB_Usuario_Area as tbua");
		$this->db->where('tbua.cd_Usuario', $id);
		$this->db->join('TB_Area as tba', 'tbua.cd_Area = tba.cd_Numero');
		return $this->db->get()->result_array();
 
	}


	public function buscarlinha($id){
		return
		$this->db->select('TB_Linha_Pesquisa.nm_Linha')
		->join('TB_Usuario_Linha', 'TB_Usuario_Linha.cd_Linha = TB_Linha_Pesquisa.cd_Linha','inner')
		->join('TB_Usuario', 'TB_Usuario.cd_Usuario = TB_Usuario_Linha.cd_Usuario','inner')
		->where('TB_Usuario.cd_Usuario', $id)
		->get('TB_Linha_Pesquisa')->result_array();
 
	} 

	public function buscar($id) {
		$professor = $this->db
			->select("
				ds_Cpf as cpf,
				nm_Usuario as nome,
				ds_Email as email,
				ds_Lattes as lattes,
				ds_Celular as celular,
				nm_Titulacao as titulacao
			")
			->where($this->primaria, $id)
			->get($this->tabela)
			->result_array();
		
		$niveis = [
			"niveis" => $this->getNiveisUsuario($id)
		];

		$areas = [
			"areas" => $this->getAreasUsuario($id)
		];

		$linhas = [
			"linhas" => $this->getLinhasUsuario($id)
		];
		

		return empty($professor) ? [] : array_merge($professor[0], $niveis, $areas, $linhas);
	}
	

}