<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends Controle_acesso {
	public function __construct() {
		parent::__construct();

		//Carregar as library e Models  podendo usar no codigo inteiro
		$this->load->library('Cpf');
		$this->load->library('Criptografar');
		$this->load->library('form_validation');
		
		$this->load->model('Usuario_model', 'user_model');

		$this->load->model('Areas_Linhas_model', 'al_model');
		$this->load->model('Professor_Model', 'prof_model'); 
		//Fim
	}
	
	//Funcao Listar
	public function listar($inicio = 0) {
		
		$id = "1";
		//Paginacao
		$config = array(
			"base_url" => base_url('administradores/listar/'),
			"per_page" => 5,
			"num_links" => 2,
			"uri_segment" => 2,
			"total_rows" => $this->user_model->ContarLinhas("1"),
			"full_tag_open" => "<div class='buttons'>",
			"full_tag_close" => "</div>",
			"first_link" => FALSE,
			"last_link" => FALSE,
			"first_tag_open" => "<button>",
			"first_tag_close" => "</button>",
			"prev_link" => "<img src='https://img.icons8.com/ios-glyphs/15/733DBF/long-arrow-left.png' alt='seta-fim'>",
			"prev_tag_open" => "<button>",
			"prev_tag_close" => "</button>",
			"next_link" => "<img src='https://img.icons8.com/ios-glyphs/15/733DBF/long-arrow-right.png' alt='seta-fim'>",
			"next_tag_open" => "<button>",
			"next_tag_close" => "</button>",
			"last_tag_open" => "<button>",
			"last_tag_close" => "</button>",
			"cur_tag_open" => "<button class='active'><a href='#'>",
			"cur_tag_close" => "</a></button>",
			"num_tag_open" => "<button>",
			"num_tag_close" => "</button>"
		);

		$this->pagination->initialize($config);
		$paginacao = $this->pagination->create_links();
		$offset = $this->uri->segment(2)?$this->uri->segment(2):0;
		$id = "master";
		$administradores = $this->user_model->getUsuario('nm_Usuario', 'ASC', $config['per_page'], $offset,$id);
		$area = $this->user_model->buscarArea($administradores['0']['cd_Usuario']);
		
		// $area = $this->prof_model->buscararea();
		
		// var_dump($administradores);
		//carrega areas do Site
		
		$this->load->view('partials/base-topo');
		$this->load->view('administradores/administradores', ['administradores' => $administradores, 'paginacao' => $paginacao, 'area' => $area]);
		$this->load->view('partials/base-fim');
	}
	
	

	


	




	//Função que adicionar os dados passados via POST
	public function adicionar(){
		
		
		$areas = $this->al_model->listarAreas();
		$linhas = $this->al_model->listarLinhas();

		//Carregamento dos pedacos da pagina  
		$this->load->view('partials/base-topo');
		$this->load->view('administradores/adicionar', ['areas' => $areas, 'linhas' => $linhas]);
		$this->load->view('partials/base-fim');	
				
		if($this->input->post()){
			

		
			$dados['nm_Usuario'] = $this->input->post('nome');
			

			if ($this->cpf->validaCPF($this->input->post('cpf'))){
				$dados['ds_Cpf'] = $this->input->post('cpf');
			} 
			else 
			{
				$this->session->set_flashdata('alert-warning','Cpf Invalido');
				
			}

			$dados['ds_Email'] = $this->input->post('email');
			$dados['nm_Titulacao'] = $this->input->post('titulacao');
			$dados['ds_Celular'] = $this->input->post('celular');
			

			if ($this->input->post('senha') === $this->input->post('csenha')) {
				$dados['ds_Senha'] = $this->criptografar->cripto($this->input->post('senha'));
			} 
			else
			{
			$this->session->set_flashdata('alert-warning', 'Senha não são iguais');
			
			}

			
				// fim de receber dados via post
				$this->form_validation->set_rules("cpf", "CPF", "required");
				$this->form_validation->set_rules("nome", "Nome", "required");
				$this->form_validation->set_rules("email", "Email", "required");
		
				if (!empty($dados["senha"])) {
				  $this->form_validation->set_rules("senha", "Senha", "required");
				  $this->form_validation->set_rules("confirmacao-senha", "Confirmação de Senha", "required|matches[senha]");
				}
		
				// $this->form_validation->set_rules("lattes", "Lattes", "required");
			
				$this->form_validation->set_rules("titulacao", "Titulação", "required");
				
				if($this->form_validation->run()){
		
				//verifica o form validation
				$this->prof_model->InserirProfessor($dados);
				$cd_Usuario = $this->prof_model->getIdUsuario($dados['ds_Cpf']);
			
			
		
				//receber dados sobre a area de pesquisa via post
				$area['cd_Usuario']  = $cd_Usuario[0]['cd_Usuario'];
				$area['cd_Area']  = $this->input->post('area');
				//fim area post

				//receber dados sobre a linha de pesquisa via post
				$linha['cd_Usuario']  = $cd_Usuario[0]['cd_Usuario'];
				$linha['cd_Linha'] = $this->input->post('linha');
				//fim area linha de pesquisa


				//Receber dados do tipo de acesso/nivel via post
				$nivel = [];
				$this->input->post('acesso1')? array_push($nivel, $this->input->post('acesso1')) : null;
				$this->input->post('acesso2')? array_push($nivel, $this->input->post('acesso2')) : null;
				$this->input->post('acesso3')? array_push($nivel, $this->input->post('acesso3')) : null;
				foreach ($nivel as $n) {
				$cd_Nivel = $this->prof_model->getIdNivel($n);
				$acesso['cd_Usuario']  = $cd_Usuario[0]['cd_Usuario'];
				$acesso['cd_Nivel'] = $cd_Nivel[0]['cd_Nivel'];
				//inserir nivel ou acesso
				$this->user_model->inserirNivel($acesso);
				//fim recerber dados nivel/acesso
				}
				$this->user_model->inserirProfessor($dados);
				//Inserir Area e Linha de Pesquisa
			    $this->user_model->inserirArea($area);
				$this->user_model->inserirLinha($linha);
					//Mensagem de sucesso	
				$this->session->set_flashdata('alert-success', 'Usuário cadastrado com sucesso');
				redirect('administradores');	
		
		}
		else{

			$this->session->set_flashdata('alert-warning', 'Você não prencheu os campos direito');


		}
		 
		}
		
		
	}
	
	public function editar($id){
		
		
		
		$areas = $this->al_model->listarAreas();
		$linhas = $this->al_model->listarLinhas();
		
		$dados = $this->prof_model->buscar($id);
	
		$acesso =$this->prof_model->buscaracesso($id);
		$area = $this->prof_model->buscararea($id);
		$linha = $this->prof_model->buscarlinha($id);

		// var_dump($area);
		// var_dump($acesso);
	
		
		$this->load->view('partials/base-topo');
		$this->load->view('administradores/editar',['dados'=> $dados, 'areas' => $areas, 'linhas' => $linhas,'acesso' => $acesso,'area' => $area, 'linha' => $linha]);
		$this->load->view('partials/base-fim');		

		if($this->input->post()){
		
			$dados['nm_Usuario'] = $this->input->post('nome');
			

		if ($this->cpf->validaCPF($this->input->post('cpf'))){
			$dados['ds_Cpf'] = $this->input->post('cpf');
		} 
		else 
		{
			$this->session->set_flashdata('alert-warning','Cpf Invalido');
			
		}

		$dados['ds_Email'] = $this->input->post('email');
		$dados['nm_Titulacao'] = $this->input->post('titulacao');
		$dados['ds_Celular'] = $this->input->post('celular');
		

		if ($this->input->post('senha') === $this->input->post('csenha')) {
			$dados['ds_Senha'] = $this->criptografar->cripto($this->input->post('senha'));
		} 
		else
		{
		$this->session->set_flashdata('alert-warning', 'Senha não são iguais');
		
		}

		
			// fim de receber dados via post
			$this->form_validation->set_rules("cpf", "CPF", "required");
			$this->form_validation->set_rules("nome", "Nome", "required");
			$this->form_validation->set_rules("email", "Email", "required");
	
			if (!empty($dados["senha"])) {
			  $this->form_validation->set_rules("senha", "Senha", "required");
			  $this->form_validation->set_rules("confirmacao-senha", "Confirmação de Senha", "required|matches[senha]");
			}
	
			// $this->form_validation->set_rules("lattes", "Lattes", "required");
		
			$this->form_validation->set_rules("titulacao", "Titulação", "required");
			
			if($this->form_validation->run()){
	
			//verifica o form validation
			$this->prof_model->InserirProfessor($dados);
			$cd_Usuario = $this->prof_model->getIdUsuario($dados['ds_Cpf']);
		
		
	
			//receber dados sobre a area de pesquisa via post
			$area['cd_Usuario']  = $cd_Usuario[0]['cd_Usuario'];
			$area['cd_Area']  = $this->input->post('area');
			//fim area post

			//receber dados sobre a linha de pesquisa via post
			$linha['cd_Usuario']  = $cd_Usuario[0]['cd_Usuario'];
			$linha['cd_Linha'] = $this->input->post('linha');
			//fim area linha de pesquisa


			//Receber dados do tipo de acesso/nivel via post
			$nivel = [];
			$this->input->post('acesso1')? array_push($nivel, $this->input->post('acesso1')) : null;
			$this->input->post('acesso2')? array_push($nivel, $this->input->post('acesso2')) : null;
			$this->input->post('acesso3')? array_push($nivel, $this->input->post('acesso3')) : null;
			foreach ($nivel as $n) {
			$cd_Nivel = $this->prof_model->getIdNivel($n);
			$acesso['cd_Usuario']  = $cd_Usuario[0]['cd_Usuario'];
			$acesso['cd_Nivel'] = $cd_Nivel[0]['cd_Nivel'];
			//inserir nivel ou acesso
				
			$this->prof_model->deleteUsuario_Nivel($id);
			$this->prof_model->deleteUsuario_Linha($id);
			$this->prof_model->deleteUsuario_Area($id);
			$this->prof_model->delete($id);
			$this->prof_model->inserirNivel($acesso);

			//fim recerber dados nivel/acesso
			}
			$this->prof_model->inserirProfessor($dados);
			//Inserir Area e Linha de Pesquisa
			$this->prof_model->inserirArea($area);
			$this->prof_model->inserirLinha($linha);
				//Mensagem de sucesso	
			$this->session->set_flashdata('alert-success', 'Usuário atualizado com sucesso');
			redirect('administradores');	
	
	}

		}	

		
	
	  }
	  
	




	//Valida as Informações dos input
	public function validar() {
		
		//Validacao de Formulario
		
	  }
	//Fim de Validacao

			 


   //Funcao Deletar
	public function deletar($id) {
		if(!$id) return redirect(administradores);
		else{
			
			
			 //Funçoes deletar
			$this->user_model->deleteUsuario_Nivel($id);
			$this->user_model->deleteUsuario_Linha($id);
			$this->user_model->deleteUsuario_Area($id);
			$this->user_model->delete($id);





		  	$this->session->set_flashdata('alert-success','Administrador excluido  com sucesso');
		    return redirect('administradores');
		} 
	  }
	//Fim da Funcao deletar   



	
  	/**
   	* Realiza as configurações necessárias a um
   	* determinado formulário que será retornado.
   	* 
   	* @param Boolean $editar  | Determina a view
   	* @param Array $dados     | Dados dos inputs
   	* @param Array $mensagens | Balões de feedback
   	* @param Integer $id      | ID do professor (p/ edição)
   	* 
  	* @return View
  	*/
	public function form($editar = false, $dados = null, $mensagens = null, $id = null) {
		$acao = $editar ? "editar" : "cadastrar";
		$caminho = "$this->diretorio/$acao";
	
		$action = $editar && !empty($id) ? "/$id" : null;
		$action = $caminho . $action;
	
		return $this->load->view("default/form", [
		  "form"      => $dados,
		  "action"    => $action,
		  "view"      => $caminho,
		  "mensagens" => $mensagens,
		]);
	  }

	  public function cadastrar() {
		$form = $this->input->post();
		return $form ? $this->salvar($form) : $this->form();
	  }
}