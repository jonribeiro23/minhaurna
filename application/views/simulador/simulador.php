
<link rel="stylesheet" href="<?= base_url('public/css/modal.css')?>" />
<!-- Banner -->
<section class="banner full">
	<article>
		<img class="fit" src="<?= base_url('public/img/background.png') ?>" alt="" />
		<div class="inner">
			<header>
				<h2>Simulador</h2>
			</header>
		</div>
	</article>				
</section>

<!-- One -->
<section id="one" class="wrapper style2">
	<div class="inner">
		<div class="">

			<div>
				<div class="box">
					<div class="image fit">
						<img src="<?= base_url('public/img/home/urna.png')?>" alt="" />
					</div>
					<div class="content">
						<header class="align-center">
							<h2>Simulador Eleitoral</h2>
						</header>

						<div class="12u$ my-4">
							<div class="select-wrapper">
								<label for="estado">Estado</label>
								<select name="estado" id="estado" onblur="carregarCidade()">
									<option value="">- Meu Estado -</option>
									<option value="AC">Acre</option>
										<option value="AL">Alagoas</option>
										<option value="AP">Amapá</option>
										<option value="AM">Amazonas</option>
										<option value="BA">Bahia</option>
										<option value="CE">Ceará</option>
										<option value="DF">Distrito Federal</option>
										<option value="ES">Espírito Santo</option>
										<option value="GO">Goiás</option>
										<option value="MA">Maranhão</option>
										<option value="MT">Mato Grosso</option>
										<option value="MS">Mato Grosso do Sul</option>
										<option value="MG">Minas Gerais</option>
										<option value="PA">Pará</option>
										<option value="PB">Paraíba</option>
										<option value="PR">Paraná</option>
										<option value="PE">Pernambuco</option>
										<option value="PI">Piauí</option>
										<option value="RJ">Rio de Janeiro</option>
										<option value="RN">Rio Grande do Norte</option>
										<option value="RS">Rio Grande do Sul</option>
										<option value="RO">Rondônia</option>
										<option value="RR">Roraima</option>
										<option value="SC">Santa Catarina</option>
										<option value="SP">São Paulo</option>
										<option value="SE">Sergipe</option>
										<option value="TO">Tocantins</option>
										<option value="EX">Estrangeiro</option>
								</select>
							</div>
						</div>

						<!-- CIDADE -->
						<div class="12u$ my-4">
							<div class="select-wrapper">
								<label for="cidade">Cidade</label>
								<select name="cidade" id="cidade">
									<option value="">- Minha Cidade -</option>
								</select>
							</div>
						</div>

						<div class="6u$ 12u$(xsmall) my4">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" value="" placeholder="Meu email" />
						</div>

						<p class="my-2">O seu voto é secreto. Seu email será usado apenas para a contagem dos votos. Não iremos te enviar nenhuma mensagem nem divulgar quais os seu candidatos preferidos.</p>

						<footer class="align-center">
							<a href="<?= base_url('votacao')?>" class="button alt">Próximo</a>
						</footer>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

Enter your name: <input type="text" id="fname" onblur="myFunction()">



<div id="modalWait" class="modal">
	 <!-- Modal content -->
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
		modalWait.style.display = "block";

		let selectEstados = document.getElementById("estado");
		let estado = selectEstados.options[selectEstados.selectedIndex].value;


		(async () => {
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

		  console.log(content)

		  if(content.status == 'ok'){
		  	content.msg.forEach(e => {
		  		let option = document.createElement('option')
		  		let value = document.createAttribute('value')
		  		value.value = e.cidade
		  		option.setAttributeNode(value)
		  		option.innerText = e.cidade
		  		selectCidade.appendChild(option)

				  	console.log(e.cidade)
				  })
		  }

		  modalWait.style.display = "none";

		  // console.log(content);
		})();
	}

</script>
