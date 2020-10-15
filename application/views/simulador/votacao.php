
<link rel="stylesheet" href="<?= base_url('public/css/modal.css')?>" />
<!-- Banner -->
<section class="banner full">
	<article>
		<img class="fit" src="<?= base_url('public/img/background.png') ?>" alt="" />
		<div class="inner">
			<header>
				<h2>Votar</h2>
			</header>
		</div>
	</article>
				
</section>

<!-- One -->
<section id="one" class="wrapper style2">
	<div class="inner">
		<div class="">

			<div>

				<!-- ANUNCIOS -->
				<div class="box">
					<div class="box alt">
						<span class="image fit my-5"><a href="<?= base_url('anuncie-conosco')?>"><img src="<?= base_url('public/img/anuncio/anuncio-wide.png')?>" alt="" /></a></span>
						<div class="row 50% uniform">
							<div class="anuncio 4u"><span class="image fit"><a href="<?= base_url('anuncie-conosco')?>">  <!-- <img src="<?= base_url('public/img/anuncio/anuncio.png')?>" alt="" /> --></a></span>
							</div>
							<div class="anuncio 4u"><span class="image fit"><a href="<?= base_url('anuncie-conosco')?>">  <img src="<?= base_url('public/img/anuncio/anuncio.png')?>" alt="" /></a></span>
							</div>
							<div class="anuncio 4u"><span class="image fit"><a href="<?= base_url('anuncie-conosco')?>">  <!-- <img src="<?= base_url('public/img/anuncio/anuncio.png')?>" alt="" /> --></a></span>
							</div>
						</div>
					</div>
				</div>

				<header class="align-center">
					<h2>Simulador Eleitoral</h2>
					<p>Digite o número do candidato ou se quiser votar em branco/nulo, clique no botão "Branco/Nulo". Depois clique em "Confirmar".</p>
				</header>
				
				<!-- VEREADOR -->
				<div class="box">
					<div id="vereadorEscolhido" class="content">
						<div id="divVereador">
							
							<div class="12u$ my-4">
								<label for="vereador">Seu voto para vereador</label>
								<input type="text" name="vereador" id="numeroVereador" value="" placeholder="Ex: 99999" />
							</div>

							<footer class="align-center">
								<button onclick="brancoVereador()" class="button alt my-3">Branco/Nulo</button>
								<button id="btnVereador" class="button alt" style='background-color: green'><span style="color: white;">Confirmar</span></button>
							</footer>
						</div>
					</div>
				</div>

				<!-- PREFEITO -->
				<div class="box">

					<div id="prefeitoEscolhido" class="content">
						<div id="divPrefeito">
							<div class="12u$ my-4">
								<label for="prefeito">Seu voto para prefeito</label>
								<input type="text" name="prefeito" id="numeroPrefeito" value="" placeholder="Ex: 99" />
							</div>

							<footer class="align-center">
								<button onclick="brancoPrefeito()" class="button alt my-3">Branco/Nulo</button>
								<button id="btnPrefeito" class="button alt" style='background-color: green'><span style="color: white;">Confirmar</span></button>
							</footer>
						</div>
					</div>
				</div>

				<!-- Confirmar -->
				<div class="box">
					<div class="content">
						<footer class="align-center">
							<form action="<?= base_url('computar-voto') ?>" method="post">
								<div id="votos">
									<input type="hidden" name="email" id="email" value="<?= $email ?>">
									<input type="hidden" name="cidade" id="cidade" value="<?= $cidade ?>">
									<input type="hidden" name="estado" id="estado" value="<?= $estado ?>">
								</div>
								<button type="submit" href="#" class="button special big"><span style="color: white;">Finalizar</span></button>
							</form>
						</footer>
					</div>
				</div>
			</div>  
		</div>
	</div>
</section>



<!-- Modal Vereador -->
<div id="modalVereador" class="modal">
	<div class="modal-content">
		<div class="modal-header" align="center">
			<span class="close">&times;</span>
			<h2>Vereador</h2>
		</div>
		<div class="modal-body" align="center">
			<div class="box" >
				<div  class="box alt">
					<div id="boxVereador" class="row 50% uniform">
						<div class=" 2u"></div>
						<div class=" 8u"><span class="image fit"><a href="<?= base_url('anuncie-conosco')?>"> <img id="fotoVereador" alt="foto do candidato" /></a></span>
						</div>
						<div class=" 2u"></div>
					</div>
				</div>
			</div>
			
			<!-- <div class="">
				<p><strong>Nome:</strong> <span id="nomeVereador">Aline e A Bancada Estudantil</span></p>
				<p><strong>Número:</strong> <span id="numeroVereadorUrna">65180</span></p>
				<p><strong>Partido:</strong> <span id="partidoVereador">PC do B - Partido Comunista do Brasil</span></p>
			</div> -->

			<div id="novosDados">
				<div id="dadosVereador">
					<p><strong>Nome:</strong> <span id="nomeVereador"></span></p>
					<p><strong>Número:</strong> <span id="numeroVereadorUrna"></span></p>
					<p><strong>Partido:</strong> <span id="partidoVereador"></span></p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button onclick="corrigeVereador()" class="button alt close" style="background-color: #fe630c"><span style="color: white;">Corrige</span></button>

			<button onclick="confirmarVereador()" class="button alt close" style='background-color: green'><span style="color: white;">Confirmar</span></button>
		</div>
	</div> 
</div> 

<!-- Modal Prefeito -->
<div id="modalPrefeito" class="modal">
	<div class="modal-content">
		<div class="modal-header" align="center">
			<span class="close2">&times;</span>
			<h2>Prefeito</h2>
		</div>
		<div class="modal-body" align="center">
			<div class="box" >
						<div class="box alt">
							<div id="boxPrefeito" class="row 50% uniform">
								<div class=" 4u"></div>
								<div class=" 4u"><span class="image fit"><a href="<?= base_url('anuncie-conosco')?>"> <img id="fotoPrefeito" alt="" /></a></span>
								</div>
								<div class=" 4u"></div>
							</div>
						</div>
					</div>
			
			<div id="novosDadosPrefeito">
				<div id="dadosPrefeito" class="">
					<p><strong>Nome: </strong> <span id="nomePrefeito"></span></p>
					<p><strong>Número: </strong> <span id="numeroPrefeitoUrna"></span></p>
					<p><strong>Partido: </strong> <span id="partidoPrefeito"></span></p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button onclick="corrigePrefeito()" class="button alt close" style="background-color: #fe630c"><span style="color: white;">Corrige</span></button>

			<button onclick="confirmarPrefeito()" class="button alt close" style='background-color: green'><span style="color: white;">Confirmar</span></button>
		</div>
	</div> 
</div>


<script>
	window.onload = function() {
		let anunciosVereadores = document.querySelectorAll('.anuncio')
				
		if (screen.width < 740 || screen.height < 480) { 
			anunciosVereadores.forEach(e => {
				e.classList.remove('4u')

			})

		}
	}
</script> 

<script src="<?= base_url('public/js/modal.js')?>"></script>
<script src="<?= base_url('public/js/votar.js')?>"></script>

