<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Acentos {
  protected $CI;
  
  public function __construct() {
    $this->CI = &get_instance();
  }

  public function remover($string) {
    $acentos = [
      "/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/",
      "/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/",
      "/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"
    ];

    return preg_replace($acentos, explode(" ", "a A e E i I o O u U n N c C"), $string);
  }
}