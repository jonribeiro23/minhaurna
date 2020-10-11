<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Paginacao {
	protected $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}
	
	public function paginate($qtd, $pagina, $base_redirect, $redirect, $max = 15) {
		$paginacao = [];
		
		$qtdPaginas = (int) count($qtd);
		$qtdPaginas = ceil($qtdPaginas / $max);
		
		if ($qtdPaginas == 0)
			redirect(base_url($base_redirect));
		else 
			if ($pagina == 0 or $pagina > $qtdPaginas)
				redirect(base_url($redirect));
		
        $offset = ($pagina == 1) ? 0 : ($pagina - 1) * $max;
        
        return $paginacao = [
        	'quantidade' => $qtdPaginas,
        	'pagina'     => $pagina,
        	'anterior'   => ($pagina > 1) ? $pagina - 1 : 1,
        	'proximo'    => ($pagina < $qtdPaginas) ? $pagina + 1 : 1,
        	'offset'     => $offset
        ];
	}
}