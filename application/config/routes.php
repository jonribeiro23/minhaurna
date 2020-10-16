<?php
defined('BASEPATH') OR exit('No direct script access allowed');

# Configuração
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


# Simulador
$route['simulador'] = 'Simulador';
$route['votacao'] = 'Simulador/votacao';
$route['computar-voto'] = 'Simulador/computarVoto';
$route['ja-votou'] = 'Simulador/jaVotou';
$route['resultados'] = 'Simulador/resultados';
$route['contagem-de-votos'] = 'Simulador/contagemVotos';

#Anúncios
$route['anuncie-conosco'] = 'Anuncios';
