<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulador extends CI_Controller {
	public function index() {
		$this->load->view('template.php', ['view' => 'simulador/simulador', 'data' => []]);
	}

	public function votacao() {
		// $url_base = 'http://localhost:5000/';
		$url_base = 'https://minha-urna.herokuapp.com/';
		$verificarSeJaVotou = $this->enviaRequest($url_base.'verificar_voto', json_encode(['email'=> $this->input->post('email')]));

		if($verificarSeJaVotou->msg){
			return redirect(base_url('ja-votou'));
		}

		$packageAnuncios = json_encode([
			'estado' => $this->input->post('estado'),
			'cidade' => $this->input->post('cidade'),
		]);

		$anuncios = $this->enviaRequest('https://adm-mu.herokuapp.com/'.'listar-por-regiao', $packageAnuncios);

		$data = [
			'email'=> $this->input->post('email'),
			'estado'=> $this->input->post('estado'),
			'cidade'=> $this->input->post('cidade'),
			'anuncios' => $anuncios->msg
		];
		$this->load->view('template.php', ['view' => 'simulador/votacao', 'data' => $data]);

	}

	public function computarVoto() {
		// $url_base = 'http://localhost:5000/';
		$url_base = 'https://minha-urna.herokuapp.com/';
		$verificarSeJaVotou = $this->enviaRequest($url_base.'verificar_voto', json_encode(['email'=> $this->input->post('email')]));

		if($verificarSeJaVotou->msg){
			return redirect(base_url('ja-votou'));
		}
		
		$package = json_encode([
			'email'=> $this->input->post('email'),
			'estado'=> $this->input->post('estado'),
			'cidade'=> $this->input->post('cidade'),
			'votos' =>[$this->input->post('votoVereador'), $this->input->post('votoPrefeito')]
		]);


		$res = $this->enviaRequest($url_base.'computar_voto', $package);
		
		if($res->status == 'ok'){
			$packageVereador = json_encode([
				'estado' => $this->input->post('estado'),
				'cidade' => $this->input->post('cidade'),
				'cargo'  => '13'
			]);

			$packagePrefeito = json_encode([
				'estado' => $this->input->post('estado'),
				'cidade' => $this->input->post('cidade'),
				'cargo'  => '11'
			]);

			$contagem_de_votos_vereadores = $this->enviaRequest($url_base.'selecionar_candidatos_resultados', $packageVereador);
			$contagem_de_votos_prefeito = $this->enviaRequest($url_base.'selecionar_candidatos_resultados', $packagePrefeito);

			
			// ONDENANDO VEREADORES POR QTD DE VOTOS
			$vereadores = (array) $contagem_de_votos_vereadores->msg;
			$vereadores = array_map(function($arr){
				return (array) $arr;
			}, $vereadores);
			
			usort($vereadores, function ($a, $b){
				$key = 'votos';
				if($a[$key] < $b[$key]){
					return 1;
				}else if($a[$key] > $b[$key]){
					return -1;
				}
				return 0;
			});

			// ONDENANDO PREFEITOS POR QTD DE VOTOS
			$prefeitos = (array) $contagem_de_votos_prefeito->msg;
			$prefeitos = array_map(function($arr){
				return (array) $arr;
			}, $prefeitos);
			
			usort($prefeitos, function ($a, $b){
				$key = 'votos';
				if($a[$key] < $b[$key]){
					return 1;
				}else if($a[$key] > $b[$key]){
					return -1;
				}
				return 0;
			});

			
			
			$data = ['vereadores' => $vereadores, 'prefeitos' => $prefeitos];
			$this->load->view('template.php', ['view' => 'simulador/obrigado', 'data' => $data]);
		}


		// SETAR MSG DE ERRO CASO NÃO HAJA RESPOSTA DA API
		// $this->load->view('template.php', ['view' => 'simulador/teste2', 'data' => []]);
	}

	public function jaVotou(){
		return $this->load->view('template.php', ['view' => 'simulador/ja-votou', 'data' => []]);
	}

	public function resultados(){
		return $this->load->view('template.php', ['view' => 'simulador/resultados', 'data' => []]);	
	}

	public function contagemVotos(){
		// $url_base = 'http://localhost:5000/';
		$url_base = 'https://minha-urna.herokuapp.com/';
		$packageVereador = json_encode([
			'estado' => $this->input->post('estado'),
			'cidade' => $this->input->post('cidade'),
			'cargo'  => '13'
		]);

		$packagePrefeito = json_encode([
			'estado' => $this->input->post('estado'),
			'cidade' => $this->input->post('cidade'),
			'cargo'  => '11'
		]);

		$contagem_de_votos_vereadores = $this->enviaRequest($url_base.'selecionar_candidatos_resultados', $packageVereador);
		$contagem_de_votos_prefeito = $this->enviaRequest($url_base.'selecionar_candidatos_resultados', $packagePrefeito);


			// ORDENANDO VEREADORES POR QTD DE VOTOS
		$vereadores = (array) $contagem_de_votos_vereadores->msg;
		$vereadores = array_map(function($arr){
			return (array) $arr;
		}, $vereadores);

		usort($vereadores, function ($a, $b){
			$key = 'votos';
			if($a[$key] < $b[$key]){
				return 1;
			}else if($a[$key] > $b[$key]){
				return -1;
			}
			return 0;
		});

			// ONDENANDO PREFEITOS POR QTD DE VOTOS
		$prefeitos = (array) $contagem_de_votos_prefeito->msg;
		$prefeitos = array_map(function($arr){
			return (array) $arr;
		}, $prefeitos);

		usort($prefeitos, function ($a, $b){
			$key = 'votos';
			if($a[$key] < $b[$key]){
				return 1;
			}else if($a[$key] > $b[$key]){
				return -1;
			}
			return 0;
		});



		$data = ['vereadores' => $vereadores, 'prefeitos' => $prefeitos];
		$this->load->view('template.php', ['view' => 'simulador/contagem-votos', 'data' => $data]);
	}

	public function enviaRequest($url, $package){
		$to_send = json_encode($package);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $to_send);

		// Set HTTP Header for POST request
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($to_send))
	);

		$res = curl_exec($ch);
		curl_close($ch);
		return json_decode($res);
	}


}
