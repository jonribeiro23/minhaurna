// Get the modal
let modalVereador = document.getElementById("modalVereador");
let modalPrefeito = document.getElementById("modalPrefeito");

// Get the button that opens the modal
let btnVereador = document.getElementById("btnVereador");
let btnPrefeito = document.getElementById("btnPrefeito");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];
let span2 = document.getElementsByClassName("close2")[0];

// When the user clicks on the button, open the modal
btnVereador.onclick = function() {
  modalVereador.style.display = "block";

  (async () => {
		let numero = document.querySelector('#numeroVereador').value
		let cidade = document.querySelector('#cidade').value
		let estado = document.querySelector('#estado').value

		let dados = {
			"cidade": cidade,
    		"estado": estado,
    		"numero": numero
		}
		// console.log(dados)
		
		// const rawResponse = await fetch('https://minha-urna.herokuapp.com/listar_cidades', {
		const rawResponse = await fetch('http://localhost:5000/selecionar_candidatos', {
			method: 'POST',
			headers: {
					'Accept': 'application/json',
					'Content-Type': 'application/json'
			},
			body: JSON.stringify(dados)
		});
		
		const content = await rawResponse.json();
		let selectCidade = document.querySelector('#cidade')

		if(content.status == 'ok'){
			let regiao = estado.toLowerCase()+'/'+cidade.toLowerCase()
			let fotoCandidato = content.msg[0].nome.replace(' ', '-').toLowerCase()
			let urlVereador = 'https://www.diariocidade.com/public/eleicoes/2020/'+regiao+'/candidatos/vereador/'+fotoCandidato+'-'+content.msg[0].numero+'.jpg'
			let nomeVereador = document.querySelector('#nomeVereador')
			let numeroVereadorUrna = document.querySelector('#numeroVereadorUrna')
			let partidoVereador = document.querySelector('#partidoVereador')
			let fotoVereador = document.querySelector('#fotoVereador')
			let srcVereador = document.createAttribute('src')
			srcVereador.value = urlVereador
			fotoVereador.setAttributeNode(srcVereador)

			console.log(urlVereador)

			nomeVereador.innerText = content.msg[0].nome
			numeroVereadorUrna.innerText = content.msg[0].numero
			partidoVereador.innerText = content.msg[0].sigla_partido + ' - ' + content.msg[0].nome_partido
		}


	})()
}

btnPrefeito.onclick = function() {
  modalPrefeito.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modalVereador.style.display = "none";
  modalPrefeito.style.display = "none";
}

span2.onclick = function() {
  modalPrefeito.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modalVereador) {
    modal.style.display = "none";
  }
} 