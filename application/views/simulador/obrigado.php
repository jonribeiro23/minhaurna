
<link rel="stylesheet" href="<?= base_url('public/css/modal.css')?>" />
<!-- Banner -->
<section class="banner full">
	<article>
		<img class="fit" src="<?= base_url('public/img/background.png') ?>" alt="" />
		<div class="inner">
			<header>
				<p>Veja os resultados abaixo</p>
				<h2>Obrigado pelo seu voto!</h2>
			</header>
		</div>
	</article>				
</section>
<section id="one" class="wrapper style2">
	<div class="inner">
		<div class="grid-style">

			<div>
				<div class="box">
					<div class="content">
						<h4>Candidatos a Vereadores</h4>
						<div class="table-wrapper">
							<table>
								<thead>
									<tr>
										<th>Número</th>
										<th>Nome</th>
										<th>Partido</th>
										<th>Votos</th>
									</tr>
								</thead>
								<tbody>

								<?php foreach ($data['vereadores'] as $vereador) { ?>
								
									<tr>
										<td><?= $vereador['dados'][0]->numero ?></td>
										<td><?= $vereador['dados'][0]->nome ?></td>
										<td><?= $vereador['dados'][0]->sigla_partido ?></td>
										<td><?= $vereador['votos'] ?></td>
									</tr>

								<?php } ?>
									
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2"></td>
										<td>100.00</td>
									</tr>
								</tfoot>
							</table>
						</div>		
					</div>
				</div>
			</div>

			<div>
				<div class="box">
					<div class="content">
						<h4>Candidatos a Vereadores</h4>
						<div class="table-wrapper">
							<table>
								<thead>
									<tr>
										<th>Número</th>
										<th>Nome</th>
										<th>Partido</th>
										<th>Votos</th>
									</tr>
								</thead>
								<tbody>

								<?php foreach ($data['prefeitos'] as $prefeito) { ?>
								
									<tr>
										<td><?= $prefeito['dados'][0]->numero ?></td>
										<td><?= $prefeito['dados'][0]->nome ?></td>
										<td><?= $prefeito['dados'][0]->sigla_partido ?></td>
										<td><?= $prefeito['votos'] ?></td>
									</tr>

								<?php } ?>
									
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2"></td>
										<td>100.00</td>
									</tr>
								</tfoot>
							</table>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- One -->
<section id="one" class="wrapper style2">
	<div class="inner">
		<div class="box">
			
		</div>
	</div>
</section>


<div id="modalWait" class="modal">
	<div class="modal-content">
		<div class="modal-header" align="center"></div>
		<div class="modal-body" align="center">
			<div class="row 50% uniform">
				<div class=" 2u"></div>
				<div class=" 8u"><span class="image fit"><img src='https://www.turia.com.br/estilo/assets/images/loader.gif' alt="" /></span>
				</div>
				<div class=" 2u"></div>
			</div>
		</div>
		<div class="modal-footer"></div>
	</div> 
</div>


<script>

	function carregarCidade() {
		let modalWait = document.getElementById("modalWait");

		let selectEstados = document.getElementById("estado");
		let estado = selectEstados.options[selectEstados.selectedIndex].value;


		if(estado != ''){
			modalWait.style.display = "block";
			
			(async () => {
			  // const rawResponse = await fetch('https://minha-urna.herokuapp.com/listar_cidades', {
			  	const rawResponse = await fetch('http://127.0.0.1:5000/listar_cidades', {
			  		method: 'POST',
			  		headers: {
			  			'Accept': 'application/json',
			  			'Content-Type': 'application/json'
			  		},
			  		body: JSON.stringify({"estado": estado})
			  	});
			  	const content = await rawResponse.json();
			  	let selectCidade = document.querySelector('#cidade')

			  	if(content.status == 'ok'){
			  		content.msg.forEach(e => {
			  			let option = document.createElement('option')
			  			let value = document.createAttribute('value')
			  			value.value = e
			  			option.setAttributeNode(value)
			  			option.innerText = e
			  			selectCidade.appendChild(option)

			  			console.log(e)
			  		})
			  	}

			  	modalWait.style.display = "none"

			  })();
			}
		}

	</script>
