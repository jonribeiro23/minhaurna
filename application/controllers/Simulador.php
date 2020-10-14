<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulador extends CI_Controller {
	public function index() {
		$this->load->view('template.php', ['view' => 'simulador/simulador', 'data' => []]);
	}

	public function votacao() {
		$dados = $this->input->post();
		// var_dump($dados);
		$data = [
			'email'=> $this->input->post('email'),
			'estado'=> $this->input->post('estado'),
			'cidade'=> $this->input->post('cidade')
		];
		$this->load->view('template.php', ['view' => 'simulador/votacao', 'data' => $data]);
		
		// $package = json_encode([
		// 	'estado' => $this->input->post('email'),
		// 	'cidade' => $this->input->post('email')
		// ]);

		// // var_dump($package);
		// // die();

		// $to_send = json_encode($package);

		// $ch = curl_init('http://localhost:5000/selecionar_candidatos');
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $to_send);

		// // Set HTTP Header for POST request
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 	'Content-Type: application/json',
		// 	'Content-Length: ' . strlen($to_send))
		// );

		// $res = curl_exec($ch);
		// curl_close($ch);
		// $res = json_decode($res);
		// var_dump($res);

	}

	public function teste2() {
		$this->load->view('template.php', ['view' => 'simulador/teste2', 'data' => []]);
	}
}
