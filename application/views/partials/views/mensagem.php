<link rel="stylesheet" href="<?= base_url('public/css/messages.css'); ?>">

<?php
  $tipos   = ["sucesso", "neutro", "erro"];
  $alertas = ["success", "normal", "warning"];

  if (!isset($flash)) $flash = [];
  if (!isset($mensagens)) $mensagens = [];

  foreach ($alertas as $alerta) {
    $indice = array_keys($alertas, $alerta)[0];
    $alerta = "alert-$alerta";
    
    $definidos = [
      "alertas"   => isset($flash[$alerta]),
      "mensagens" => isset($mensagens[$indice])
    ];
    
    if ($definidos["alertas"]) {
      $mensagens[$tipos[$indice]] = $flash[$alerta];
    }
  }
?>

<div class="alertas">
  <?php
    if (isset($mensagens)) {
      foreach ($mensagens as $mensagem) {
        $tipo = array_keys($mensagens, $mensagem)[0]; 
        $tipo = $tipo == 'customizado' ? 'neutro' : $tipo;

        if ($mensagem && !empty($mensagem)) {?>
          <div class="alerta alerta-<?= $tipo ?> animated fadeInRightBig">
            <div class="alerta-icone">
              <img src="<?= base_url('public/img/logo-fatec.png') ?>">
            </div>
            
            <div class="container">
              <span class="msg"><?= $mensagem ?></span>
              <img src="<?= base_url('public/img/icons/cancel.svg') ?>" class="alerta-fechar">
            </div>
          </div> <?php
        }
      }
    }
  ?>
</div>

<script src="<?= base_url('public/js/libraries/jquery-2.2.4.min.js') ?>"></script>
<script src="<?= base_url('public/js/partials/mensagem.js') ?>"></script>