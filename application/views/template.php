<!Doctype html>

<html lang="pt-br">

<head>
	<title>Minha Urna</title>
	<meta charset="utf-8">

	<link href="public/css/bootstrap.css" rel="stylesheet">
	<link href="public/css/main.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">

	<script src="https://kit.fontawesome.com/72c6380c9f.js"></script>
</head>

<body>

	

	<?php $this->load->view('partials/menu'); ?>	
	<?php $this->load->view($view, $data); ?>


	<div class="card text-center">
		
		<div class="card-body">
		<a href="#" class="btn btn-outline-dark my-1">Sobre nós</a>
		<a href="#" class="btn btn-outline-dark my-1">Contato</a>
		<a href="#" class="btn btn-outline-dark my-1">Política de privacidade</a>
		</div>
		<div class="card-footer text-muted">
		Cassandra Criações &copy - 2020
		</div>
	</div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>