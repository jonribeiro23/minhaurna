
<div class="container-fluid mt-5">
	
	<div class="row">
		<div class="col-1 col-sm-1 col-lg-3"></div>
		<div class="col-10 col-sm-10 col-lg-6">
			<img class="img-fluid" src="<?= base_url('public/img/logo.png') ?>">
		</div>
		<div class="col-1 col-sm-1 col-lg-3"></div>
	</div>

	<div class="row mt-5">
		<div class="col-1 col-sm-1 col-lg-3"></div>
		<div class="col-10 col-sm-10 col-lg-6">

				<div class="card-transparente" align="center">
					<h3 class="card-title">Simulador Eleitoral</h3>
					<p class="card-text">Vote em seus candidatos e veja quais estão liderando a corrida eleitoral.</p>
					<a href="#" class="btn btn-primary btn-lg">Votar</a>
				</div>

		</div>
		<div class="col-1 col-sm-1 col-lg-3"></div>
	</div>

	<div class="row my-5">
		<div class="col-1 col-sm-1 col-lg-3"></div>
		<div class="col-10 col-sm-10 col-lg-6">

				<div class="card-transparente" align="center">
					<h3 class="card-title">Anuncie aqui</h3>
					<p class="card-text">Você é um candidato à prefeito ou vereador? Tenha mais chances de ser eleito anunciando sua campanha conosco!</p>
					<a href="#" class="btn btn-success btn-lg">Saiba Mais</a>
				</div>

		</div>
		<div class="col-1 col-sm-1 col-lg-3"></div>
	</div>
		
</div>

<script>
	window.onload = function() {
		let cardPadding = document.querySelectorAll('.card-transparente')
		let txtSize = document.querySelectorAll('p')
		let h3Size = document.querySelectorAll('h3')
		let btnSize = document.querySelectorAll('.btn')
		
		if (screen.width < 740 || screen.height < 480) { 
			
			cardPadding.forEach(e => {
				e.style.padding = '100px'
			})

			txtSize.forEach(e => {
				e.style.fontSize = '2.9em'
			})

			h3Size.forEach(e => {
				e.style.fontSize = '4.3em'
			})

			btnSize.forEach(e => {
				e.style.fontSize = '2.9em'
			})

		} else {
			txtSize.forEach(e => {
				e.style.fontSize = '1.2em'
			})
		
		}
	}

	// var x = window.matchMedia("(max-width: 800.98px)")
	// myFunction(x) // Call listener function at run time
	// x.addListener(myFunction) // Attach listener function on state changes 
</script>	
	

	