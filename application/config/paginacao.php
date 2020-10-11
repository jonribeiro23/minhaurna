<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| CONFIGURAÇÃO Da PAGINAÇÃO
| -------------------------------------------------------------------
| Segue as configurações de abertura e fechamendo dos links,
| para o funcionamento correto no layout
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
|
*/
// PAGINACAO CONFIG
// tag principal
$config["paginacao"]['full_tag_open'] = "<ul class=\"pagination\">\n";
$config["paginacao"]['full_tag_close'] = "\n\t\t</ul>\n";

//$config["paginacao"]['page_query_string'] = TRUE;
//$config["paginacao"]['use_page_numbers'] = TRUE;
$config["paginacao"]['display_pages'] = TRUE;

$config["paginacao"]['first_tag_open'] = "\t\t\t<li>\n\t\t\t\t";
$config["paginacao"]['first_tag_close'] = "\n\t\t\t</li>";
$config["paginacao"]['last_tag_open'] = "\t\t\t<li>\n\t\t\t\t";
$config["paginacao"]['last_tag_close'] = "\n\t\t\t</li>";

$config["paginacao"]['cur_tag_open'] = "\n\t\t\t<li>\n\t\t\t\t<a>";
$config["paginacao"]['cur_tag_close'] = "</a>\n\t\t\t</li>";

$config["paginacao"]['prev_tag_open'] = "\n\t\t\t<li>\n\t\t\t\t";
$config["paginacao"]['prev_tag_close'] = "\n\t\t\t</li>";
$config["paginacao"]['prev_link'] = "<span aria-hidden=\"true\">&lt;</span>";

$config["paginacao"]['next_tag_open'] = "\n\t\t\t<li>\n\t\t\t\t";
$config["paginacao"]['next_tag_close'] = "\n\t\t\t</li>\n";
$config["paginacao"]['next_link'] = "<span aria-hidden=\"true\">&gt;</span>";

$config["paginacao"]['first_link'] = "<span aria-hidden=\"true\">&laquo;</span>";
$config["paginacao"]['last_link'] = "<span aria-hidden=\"true\">&raquo;</span>";


$config["paginacao"]['num_tag_open'] = "\n\t\t\t<li>\n\t\t\t\t";
$config["paginacao"]['num_tag_close'] = "\n\t\t\t</li>";
//$config["paginacao"]['prefix'] = 'PRIMEIRO';
//$config["paginacao"]['suffix'] = 'ULTIMO';
// FIM PAGINACAO CONFIG