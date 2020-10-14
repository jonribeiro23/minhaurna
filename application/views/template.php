<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Minha Urna</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="<?= base_url('public/assets/css/main.css')?>" />
		<link rel="stylesheet" href="<?= base_url('public/css/margin.css')?>" />
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="<?= base_url() ?>"><img class="fit" src="<?= base_url('public/img/logo2.png') ?>"></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="<?= base_url() ?>">Início</a></li>
					<li><a href="<?= base_url('simulador') ?>">Simulador</a></li>
					<li><a href="<?= base_url('anuncie-conosco') ?>">Anuncie aqui</a></li>
				</ul>
			</nav>


				<main>
					<?php $this->load->view($view, $data); ?>	
				</main>


			<!-- Two -->
			<section id="two" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Informações atualizadas sobre intenções de votos para seus candidatos</p>
						<h2>Minha Urna</h2>
						<a href="#" class="button alt">Sobre nós</a>
						<a href="#" class="button alt">Contato</a>
						<a href="#" class="button alt">Política de privacidade</a>
					</header>
				</div>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					&copy; Cassandra Criações. All rights reserved.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="<?= base_url('public/assets/js/jquery.min.js')?>"></script>
			<script src="<?= base_url('public/assets/js/jquery.scrollex.min.js')?>"></script>
			<script src="<?= base_url('public/assets/js/skel.min.js')?>"></script>
			<script src="<?= base_url('public/assets/js/util.js')?>"></script>
			<script src="<?= base_url('public/assets/js/main.js')?>"></script>

	</body>
</html>
