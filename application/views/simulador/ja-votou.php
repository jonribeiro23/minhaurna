
<link rel="stylesheet" href="<?= base_url('public/css/modal.css')?>" />
<!-- Banner -->
<section class="banner full">
	<article>
		<img class="fit" src="<?= base_url('public/img/background.png') ?>" alt="" />
		<div class="inner">
			<header>
				<h2>Obrigado</h2>
			</header>
		</div>
	</article>				
</section>
<section id="one" class="wrapper style2">
	<div class="inner">
		<div class="grid-style">

			<div>
				<div class="box">
					<div class="content" align="center">
						<p class="my-5">Você já voutou uma vez com esse email e seu voto já foi computado.</p>
						<a href="<?= base_url('resultados') ?>" class="button alt">RESULTADOS</a href="">
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
