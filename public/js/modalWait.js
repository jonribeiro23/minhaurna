// Get the modal
let modalPrefeito = document.getElementById("modalWait");

// Get the button that opens the modal
let btnVereador = document.getElementById("btnVereador");
let btnPrefeito = document.getElementById("btnPrefeito");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];
let span2 = document.getElementsByClassName("close2")[0];

// When the user clicks on the button, open the modal
btnVereador.onclick = function() {
  modalVereador.style.display = "block";
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
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 