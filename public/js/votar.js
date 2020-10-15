function brancoVereador(){
	let vereador = document.querySelector('#numeroVereador')
	let valueBranco = document.createAttribute('value')
	valueBranco.value = 'BRANCO/NULO'
	vereador.setAttributeNode(valueBranco)
}


function brancoPrefeito(){
	let prefeito = document.querySelector('#numeroPrefeito')
	let valueBranco = document.createAttribute('value')
	valueBranco.value = 'BRANCO/NULO'
	prefeito.setAttributeNode(valueBranco)
}

function corrigeVereador(){
	// let modalVereador = document.getElementById("modalVereador")
	// let vereador = document.querySelector('#numeroVereador')
	// let valueBranco = document.createAttribute('value')
	// valueBranco.value = ''
	// vereador.setAttributeNode(valueBranco)
	// modalVereador.style.display = "none"

	location.reload()
}

function corrigePrefeito(){
	// let modalPrefeito = document.getElementById("modalPrefeito");
	// let prefeito = document.querySelector('#numeroPrefeito')
	// let valueBranco = document.createAttribute('value')
	// valueBranco.value = ''
	// prefeito.setAttributeNode(valueBranco)
	// modalPrefeito.style.display = "none"
	location.reload()
}


function confirmarVereador(){
	let modalVereador = document.getElementById("modalVereador")
	let votos = document.querySelector('#votos')
	let vereador = document.querySelector('#numeroVereador').value
	let dadosVereador = document.querySelector('#novosDados')
	let divVereador = document.querySelector('#divVereador')
	let vereadorEscolhido = document.querySelector('#vereadorEscolhido')
	
	let inputVereador = document.createElement('input')
	let h3 = document.createElement('h3')

	h3.innerText = 'Vereador escolhido:'

	// REMOVENDO INPUT DE VOTO PARA VEREADOR
	divVereador.parentNode.removeChild(divVereador)


	// SETANDO DADOS PARA COMPUTAR VOTO
	inputVereador.setAttribute('value', vereador)
	inputVereador.setAttribute('name', 'votoVereador')
	inputVereador.setAttribute('type', 'hidden')

	// COLOCANDO DADOS DO VEREADOR ESCOLHIDO NA DIVI
	vereadorEscolhido.appendChild(h3)
	vereadorEscolhido.appendChild(dadosVereador)
	votos.appendChild(inputVereador)
	modalVereador.style.display = "none"
}


function confirmarPrefeito(){
	let modalPrefeito = document.getElementById("modalPrefeito")
	let votos = document.querySelector('#votos')
	let prefeito = document.querySelector('#numeroPrefeito').value
	let dadosPrefeito = document.querySelector('#novosDadosPrefeito')
	let divPrefeito = document.querySelector('#divPrefeito')
	let prefeitoEscolhido = document.querySelector('#prefeitoEscolhido')
	
	let inputPrefeito = document.createElement('input')
	let h3 = document.createElement('h3')

	h3.innerText = 'Prefeito escolhido:'

	// REMOVENDO INPUT DE VOTO PARA VEREADOR
	divPrefeito.parentNode.removeChild(divPrefeito)


	// SETANDO DADOS PARA COMPUTAR VOTO
	inputPrefeito.setAttribute('value', prefeito)
	inputPrefeito.setAttribute('name', 'votoPrefeito')
	inputPrefeito.setAttribute('type', 'hidden')

	// COLOCANDO DADOS DO VEREADOR ESCOLHIDO NA DIVI
	prefeitoEscolhido.appendChild(h3)
	prefeitoEscolhido.appendChild(dadosPrefeito)
	votos.appendChild(inputPrefeito)
	modalPrefeito.style.display = "none"
}