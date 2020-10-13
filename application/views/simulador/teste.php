<link href="<?= base_url('public/css/simulador-teste.css')?>" rel="stylesheet">
<link href="<?= base_url('public/js/teclado.js')?>" rel="stylesheet">

<div class="row">
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
	<div class="col-sm-10 col-md-8 col-lg-4 align-middle" align="center">
		<div class="card ">
			<img src="..." class="card-img-top" alt="...">
			<div class="card-body">
				<div id="div_visor"><input type="text" id="visor" disabled="disabled" placeholder="0.00"/></div>
			</div>
		</div>
	</div>
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
</div>

<div class="row" align="center">
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
	<div class="col-sm-10 col-md-8 col-lg-4 align-middle" align="center">
		<!-- teclado -->
		<div class="preto">
			<button class="bntu click" id="um" value="1"><span class="number">1</span></button>
			<button class="bntu click" id="dois" value="2"><span class="number">2</span></button>
			<button class="bntu click" id="tres" value="3"><span class="number">3</span></button>
			<button class="bntu click" id="quatro" value="4"><span class="number">4</span></button>
			<button class="bntu click" id="cinco" value="5"><span class="number">5</span></button>
			<button class="bntu click" id="seis" value="6"><span class="number">6</span></button>
			<button class="bntu click" id="sete" value="7"><span class="number">7</span></button>
			<button class="bntu click" id="oito" value="8"><span class="number">8</span></button>
			<button class="bntu click" id="nove" value="9"><span class="number">9</span></button>
			<button class="bntu click" id="zero" value="0"><span class="number">0</span></button>
			<div class="teclado2">
				<button class="branco  my-1 click">BRANCO</button>
				<button class="laranja  my-1 click">CORRIGE</button>
				<button class="verde  my-1">CONFIRMA</button>
		 	</div>
		</div>
		<!-- /teclado -->
	</div>
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
</div>


<script>
	window.onload = function() {
		let txtSize = document.querySelectorAll('p')
		let btnTeclado = document.querySelectorAll('.bntu')
		let number = document.querySelectorAll('.number')
		let teclado = document.querySelector('.preto')
		let teclado2 = document.querySelector('.teclado2')
		let branco = document.querySelector('.branco')
		let laranja = document.querySelector('.laranja')
		let verde = document.querySelector('.verde')
		
		if (screen.width < 740 || screen.height < 480) { 

			txtSize.forEach(e => {
				e.style.fontSize = '2.9em'
			})

			btnTeclado.forEach(e => {
				e.style.width = '25%'
				e.style.height = '15%'
			})

			number.forEach(e => {
				e.style.fontSize = '2.9em'
			})


			teclado.style.width = '500px'
			teclado.style.height = '760px'
			
			let larguraTela = screen.width;
			let posicaoX = (larguraTela / 2) - (500  / 2)
			console.log(posicaoX)
			teclado.style.left = '15%'

			branco.style.fontSize = '3em'
			laranja.style.fontSize = '3em'
			verde.style.fontSize = '3em'
			verde.style.width = '50%'
			verde.style.height = '100px'

		} else {
			txtSize.forEach(e => {
				e.style.fontSize = '1.2em'
			})

			branco.style.fontSize = '1em'
			laranja.style.fontSize = '1em'
			verde.style.fontSize = '1em'
			verde.style.width = '50%'
			verde.style.height = '40px'
			teclado2.style.left = '15%'
		
		}
	}

	// var x = window.matchMedia("(max-width: 800.98px)")
	// myFunction(x) // Call listener function at run time
	// x.addListener(myFunction) // Attach listener function on state changes 
</script>
