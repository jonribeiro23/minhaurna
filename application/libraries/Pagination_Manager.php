<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_Manager {
	private $total;
	private $pagina;
	private $filtro;
	private $index  = 3;
	private $maximo = 10;
	
	protected $CI;

	public function __construct($params) {
		$this->CI =& get_instance();
		
		$this->pagina = $params['pagina'];
		$this->total  = $params['total'];
		
		if (!empty($params['index']))  $this->index  = $params['index'];
		if (!empty($params['maximo'])) $this->maximo = $params['maximo'];
		if (!empty($params['filtro'])) $this->filtro = $params['filtro'];
		
		$this->CI->config->load('paginacao');
		$this->CI->load->library('pagination');
		
		$this->CI->paginacao = $this->CI->config->item("paginacao");
		$this->CI->pagination->initialize($this->paginacao());
	}

	public function paginacao() {
		$config = $this->CI->paginacao;
		
        $config['base_url']    = base_url($this->pagina .'/listar');
        $config['total_rows']  = $this->total;
        $config['per_page']    = $this->maximo;
        $config['next_link']   = 'Próximo';
        $config['prev_link']   = 'Anterior';
        $config['uri_segment'] = $this->index;
        
        if (!empty($this->filtro)) {
	        $config['first_url'] = 0 .$this->filtro;
			$config['suffix']    = $this->filtro;
        }

        return $config;
    }
    
    public function links() {
    	return $this->CI->pagination->create_links();
    }
}