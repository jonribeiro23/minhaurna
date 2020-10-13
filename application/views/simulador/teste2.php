<link href="<?= base_url('public/css/simulador-teste.css')?>" rel="stylesheet">
<div class="container">
	<div class="row">
		<!-- entrada dos dados -->
		<div class="col">
			<div>
				<div class="card-transparente card-padding" align="center">
					
					<div class="row">
						<div class="col">
							<label>Digite o número do candidato ou aperte o botão "Branco"</label>
								<input type="text" name="">
						</div>
					</div>

					<div class="row">
						<div class="col">
							<button class="btn btn-light my-2">Branco</button>
							<button class="btn btn-corrige my-2">Corrige</button>
							<button class="btn btn-success my-2">Confirma</button>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- /entrada dos dados -->
		
		<!-- info do candidato -->
		<div class="col">
			<div class="card">
				<div class="row">
					<div class="col" align="center">
						<img class="img-fluid tamanho-img" src="<?= base_url('public/img/FSP250000634426_div.jpg') ?>" alt="Card image cap">
					</div>
					<div class="col">
						<div class="card-body">
							<p class="card-text"><strong>Cargo: </strong> Vereador</p>
							<p class="card-text"><strong>Número: </strong> 99.999</p>
							<p class="card-text"><strong>Nome: </strong> Fulano de tal</p>
							<p class="card-text"><strong>Partido: </strong> PMUS</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /info do candidato -->
	</div>
</div>