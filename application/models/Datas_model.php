<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
class Datas_model extends CI_MODEL {
	private $now;
	
	public function __construct() {
    	parent::__construct();
    	date_default_timezone_set('America/Sao_Paulo');
    	$this->now = date('Y-m-d');
	}
	
	public function all(){
	    $this->db->select('*');
	    $this->db->from('TB_Evento');
	    return $this->db->get()->result_array();
	}
	
	public function save($dados) {
        return $this->db->insert('TB_Calendario', $dados);
    }
	
	//Retorna true se o evento passado estará ocorrendo na data passada. 
	//Caso a data não seja passada, verifica se está ocorrendo agora.
	public function verificaEventoData($evento, $data = null) {
	    if ($data == null) $data = $this->now;
		$resultado = $this->db->select('ev.cd_Evento, ev.nm_Evento')
			->from('TB_Evento AS ev')
			->join('TB_Calendario AS dt', 'ev.cd_Evento = dt.cd_Evento')
			->where('dt.dt_Inicial <=', $data)
			->where('dt.dt_Final >=', $data)
			->where('ev.cd_Evento', $evento)
			->group_by('ev.cd_Evento')
			->count_all_results();
		return $resultado > 0;
	}
	
	//Retorna quais eventos estão ocorrendo na data passada.
	//Se nada for passado retorna todos os eventos.
	public function getEventos($data = null) {
		$this->db->select('ev.cd_Evento, ev.nm_Evento')
			->from('TB_Evento AS ev');
		if (!empty($data)){
			$this->db->join('TB_Calendario AS dt', 'ev.cd_Evento = dt.cd_Evento')
				->where('dt.dt_Inicial <=', $data)
				->where('dt.dt_Final >=', $data)
				->group_by('ev.cd_Evento');
		}
		return $this->db->get()->result();
		
	}
}