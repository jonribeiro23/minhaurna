<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Criptografar {
    
    function cripto($txt) {
        return hash('sha256', md5($txt));
    }
}
