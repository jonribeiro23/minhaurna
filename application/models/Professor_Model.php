<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Professor_Model extends CI_Model {
	protected $tabela   = "TB_Usuario";
	protected $primaria = "cd_Usuario";
	
	public function __construct() {
		parent::__construct();
	}
	
	public function listar() {
		return $this->db
			->select("
				cd_Usuario as id,
				nm_Usuario as nome,
				ds_Email as email,
				nm_Titulacao as titulacao
			")
			->get($this->tabela)
			->result();
	}

	/**
	 * Realiza o cadastro do(a) professor(a)
	 * 
	 * @param Array $professor
	 * @return Integer|False
	*/
	public function cadastrar($professor) {
		return $this->db->insert($this->tabela, $this->formataDados($professor));
		
		$id_professor = $this->db->insert_id();

		return empty($id_professor) ? false : $id_professor;
	}
		
	/**
	 * Realiza a atualização do(a) professor(a)
	 * 
	 * @param Array $professor
	 * @param Integer $id
	 * 
	 * @return Boolean
	*/
	public function editar($professor, $id) {
		return $this->db
			->where($this->primaria, $id)
			->update($this->tabela, $this->formataDados($professor));
	}

	/**
	 * Realiza busca com base no id do(a) professor(a)
	 * 
	 * @param Integer $id
	 * @return Object
	*/
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
	
	/**
	 * Verifica se já existe algum valor que
	 * vá de encontro com a coluna especificada.
	 * 
	 * @param String $coluna | Ex.: nm_Usuario
	 * @param String $busca  | Ex.: João da Silva
	 * 
	 * @return Boolean
	*/
	public function existeRegistro($coluna, $busca, $id = null) {
		$this
			->db
			->select($coluna)
			->where($coluna, $busca);
		
		if (!empty($id)) {
			$this->db->where("$this->primaria <>", $id);
		}

		$professor = $this
			->db
			->get($this->tabela)
			->row_array();
		
		return !empty($professor[$coluna]);
	}

	/**
	 * Formata os dados provenientes do formulário
	 * e os indexa conforme as colunas existentes
	 * na base de dados.
	 * 
	 * @param Array $dados
	 * @return Array
	*/
	public function formataDados($dados) {
		return [
			"ds_Cpf"       => $dados["cpf"],
			"nm_Usuario"   => $dados["nome"],
			"ds_Email"     => $dados["email"],
			"ds_Senha"     => $dados["senha"],
			"ds_Lattes"    => $dados["lattes"],
			"ds_Celular"   => $dados["celular"],
			"nm_Titulacao" => $dados["titulacao"],
		];
	}

	/** 
	 * Retorna os níveis de um usuário
	 * através do id.
	 * 
	 * @param Integer $id
	 * @return Array
	 */
	public function getNiveisUsuario($id){
		return $this->db
			->select("
				n.cd_Nivel as cdNivel,
				n.nm_Nivel as nmNivel
			")
			->from("TB_Usuario_Nivel as un")
			->join("TB_Nivel as n","un.cd_Nivel = n.cd_Nivel")
			->where("un.cd_Usuario", $id)
			->get()
			->result_array();
	}
		
	/** 
	 * Retorna as áreas de um usuário
	 * através do id.
	 * 
	 * @param Integer $id
	 * @return Array
	 */
	public function getAreasUsuario($id){
		return $this->db
			->select("
				a.cd_Numero as cdArea,
				a.nm_Area as nmArea
			")
			->from("TB_Usuario_Area as ua")
			->join("TB_Area as a","ua.cd_Area = a.cd_Numero")
			->where("ua.cd_Usuario", $id)
			->get()
			->result_array();
	}

	/** 
	 * Retorna as linhas de pesquisa
	 * de um usuário através do id.
	 * 
	 * @param Integer $id
	 * @return Array
	 */
	public function getLinhasUsuario($id){    
		return $this->db
			->select("
				l.cd_Numero as cdLinha,
				l.nm_Linha as nmLinha
			")
			->from("TB_Usuario_Linha as ul")
			->join("TB_Linha_Pesquisa as l","ul.cd_Linha = l.cd_Numero")
			->where("ul.cd_Usuario", $id)
			->get()
			->result_array();
	}

	/** 
	 * Cadastra a relação de um
	 * usuário com uma área.
	 * 
	 * @param Integer $cdUsuario
	 * @param Integer $cdArea
	 * @return Boolean
	 */
	public function cadastrarUsuarioArea($cdUsuario, $cdArea) {
		$dados = [
			'cd_Area' => $cdArea,
			'cd_Usuario' => $cdUsuario
		];

		return $this->db->insert('TB_Usuario_Area', $dados);
	}

	/** 
	 * Cadastra a relação de um
	 * usuário com uma linha.
	 * 
	 * @param Integer $cdUsuario
	 * @param Integer $cdLinha
	 * @return Boolean
	 */
	public function cadastrarUsuarioLinha($cdUsuario, $cdLinha) {
		$dados = [
			'cd_Linha' => $cdLinha,
			'cd_Usuario' => $cdUsuario
		];

		return $this->db->insert('TB_Usuario_Linha', $dados);
	}
	
	/** 
	 * Cadastra a relação de um
	 * usuário com uma nivel.
	 * 
	 * @param Integer $cdUsuario
	 * @param Integer $cdNivel
	 * @return Boolean
	 */
	public function cadastrarUsuarioNivel($cdUsuario, $cdNivel) {
		$dados = [
			'cd_Nivel' => $cdNivel,
			'cd_Usuario' => $cdUsuario
		];

		return $this->db->insert('TB_Usuario_Nivel', $dados);
	}

	/** 
	 * Exclui todas as relações
	 * entre um usuário e suas áreas
	 * 
	 * @param Integer $cdUsuario
	 * @return Boolean
	 */
	public function excluirUsuarioAreas($cdUsuario) {
		$this->db->where('cd_Usuario', $cdUsuario);

		return $this->db->delete('TB_Usuario_Area', $dados);
	}

		/** 
	 * Exclui todas as relações
	 * entre um usuário e suas linhas
	 * 
	 * @param Integer $cdUsuario
	 * @return Boolean
	 */
	public function excluirUsuarioLinhas($cdUsuario) {
		$this->db->where('cd_Usuario', $cdUsuario);

		return $this->db->delete('TB_Usuario_Linha', $dados);
	}

		/** 
	 * Exclui todas as relações
	 * entre um usuário e seus niveis
	 * 
	 * @param Integer $cdUsuario
	 * @return Boolean
	 */
	public function excluirUsuarioNiveis($cdUsuario) {
		$this->db->where('cd_Usuario', $cdUsuario);

		return $this->db->delete('TB_Usuario_Nivel', $dados);
	}
	



	//Front Administrador----------------------------------------------------------------------------------------------
	
	//Inserir
	
		/**
	 * Realiza o cadastro do(a) professor(a)
	 * 
	 * 
	 * Inseri Professor (Front Administradores)
	 * 
	*/
	public function inserirProfessor($dados){
		return $this->db->insert('TB_Usuario', $dados);
	}
	
	/**
	 * Realizar o cadastro da Area
	 * 
	 * 
	 * Cadastra a Area de Pesquisa (Front Administradores)
	 * 
	*/
	public function inserirArea($dados){
		return $this->db->insert('TB_Usuario_Area',$dados);
	}
	
		/**
	 * Realizar o cadastro da Linha de Pesquisa
	 * 
	 * 
	 * Cadastra a Area de Pesquisa (Front Administradores)
	 * 
	*/
	public function inserirLinha($dados){
		return $this->db->insert('TB_Usuario_Linha',$dados);
	}


	 /**
	 * Realizar o cadastro do Nivel de Acesso
	 * 
	 * 
	 * Cadastra a Nivel de Acesso (Front Administradores)
	 * 
	*/
	public function inserirNivel($dados){
		return $this->db->insert('TB_Usuario_Nivel',$dados);    
	}
	

	/**
	 * Captura id de um Nivel de acesso(Front Administradores)
	 * 
	 * 
	 * 
	 * 
	*/
	public function getIdNivel($nivel){
		$this->db->select('cd_Nivel');
		$this->db->from('TB_Nivel');
		$this->db->where('nm_Nivel', $nivel);
		return $this->db->get()->result_array();
	}

		/**
	 * Captura id de um Professor(Front Administradores)
	 * 
	 * 
	 * 
	 * 
	*/
	public function getIdUsuario($cpf){
		$this->db->select('cd_Usuario');
		$this->db->from('TB_Usuario');
		$this->db->where('ds_Cpf', $cpf);
		return $this->db->get()->result_array();
	}
	
	 /**
	 * Captura id de um Professor para paginação(Front Administradores)
	 * 
	 * 
	 * 
	 * 
	*/
	public function getAdministrador($sort='cd_Usuario', $order='ASC', $limit=null, $offset=null){
		$this->db->order_by($sort, $order);

		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$query = 
		$this->db->Select('TB_Usuario.*, TB_Usuario_Nivel.*, TB_Nivel.*');
		$this->db->join('TB_Usuario_Nivel', 'TB_Usuario.cd_Usuario = TB_Usuario_Nivel.cd_Usuario');
		$this->db->join('TB_Nivel', 'TB_Usuario_Nivel.cd_Nivel = TB_Nivel.cd_Nivel');
		$this->db->from('TB_Usuario');
		$query = $this->db->get()->result_array();

		return $query;

		
	}
	


	//Funçoes deletar

		 /**
	 * Deleta Administradores 
	 * 
	 * 
	 * 
	 * 
	*/
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
	//fim deletar


	 //Contar linhas

		 /**
	 * Contar o numero de linhas da tabela usuarios do banco
	 * 
	 * 
	 * 
	 * 
	*/
	public function ContarLinhas(){
		return $this->db->count_all('TB_Usuario');
	}
	
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

	//-----------------------------------------------------------------------------------------------------
	//Avaliadores// Front

	public function ContarLinhasAvaliador($id){
		return $this->db->from('TB_Usuario_Nivel')->where('cd_Nivel', $id)->count_all_results();
	}
	

	public function getAvaliador($sort='cd_Usuario', $order='ASC', $limit=null, $offset=null){

		
		$this->db->order_by($sort, $order);
		$id='3';
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		$query = 
			$this->db->Select('TB_Usuario.*, TB_Usuario_Nivel.*, TB_Nivel.*');
			$this->db->join('TB_Usuario_Nivel', 'TB_Usuario.cd_Usuario = TB_Usuario_Nivel.cd_Usuario');
			$this->db->join('TB_Nivel', 'TB_Usuario_Nivel.cd_Nivel = TB_Nivel.cd_Nivel');
			$this->db->from('TB_Usuario')->where('TB_Nivel.nm_Nivel','avaliador');
			$query = $this->db->get()->result_array();

			return $query;
	}
	

	function atualizar($dados,$id) {
			 $this->db->where('cd_Usuario',$id );
			 $this->db->update('Tb_Usuario',$dados); 
		}
	

}