///////////////////////////////////////////////////////

// Project: Calculator JS
// Autor:   Valdiney França
// Data:    21/07/2013

//////////////////////////////////////////////////////

 window.onload = function() {
  alert('msg')
 
 var messageError = document.getElementById('erros'),
 reportCalculator = document.getElementById('b_resultados'),
 visor = document.getElementById('visor').value;
 

/////////////////////////////////////////////////////
// Class Math functions
////////////////////////////////////////////////////

 function MathFunctions(visor) {
  this.visor = visor;
  this.rootSquare = function() {
    organizeNumbers(' = Raiz ' + Math.sqrt(this.visor));
  };
  
  this.percentage = function() {
    organizeNumbers('/100');
  };
  
  this.constantPI = function() {
    organizeNumbers(' PI = '+2*Math.PI*this.visor);
  };
 }

///////////////////////////////////////////////////////
 
 
///////////////////////////////////////////////////////
// Loop search values of the buttons in html elements
//////////////////////////////////////////////////////

 var buttons = document.querySelectorAll('.bntu');
  for(var i = 0; i< buttons.length; i++) {
    buttons[i].onclick = includeValuesButtons(i);
 }
  
//////////////////////////////////////////////////////
// This function include the values of the buttons in the function 'organizeNumbers'.
/////////////////////////////////////////////////////

 function includeValuesButtons(values) {
  return function() {
    organizeNumbers(document.querySelectorAll('.bntu')[values].value);
  }
 }
 
//////////////////////////////////////////////////////
// To organize the numbers in the visor
/////////////////////////////////////////////////////

 function organizeNumbers(numbers) {
    document.getElementById('visor').value = document.getElementById('visor').value + numbers;
 }
 
/////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////
// This functions call the some function of the class MathFunctions
//////////////////////////////////////////////////////////////////////

 var buttonRootSquare = document.getElementById('raiz_quadrada').onclick = function() {
  var Math = new MathFunctions(document.getElementById('visor').value);
   Math.rootSquare();
 }

 var porcentagem = document.getElementById('porcentagem').onclick = function() { 
  var Math = new MathFunctions(document.getElementById('visor').value);
   Math.percentage();
 }

 var constante_pi = document.getElementById('pi').onclick = function() { 
  var Math = new MathFunctions(document.getElementById('visor').value);
   Math.constantPI();
 }

/////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////
// Function 'ecuals' make the calculation
/////////////////////////////////////////////////////

 var equals = document.getElementById('igual').onclick = function() {
  var visor = document.getElementById('visor').value;
 
  if(visor == '') {
     messageError.innerHTML = 'Digite números e operadores antes de computar. Exemplo: 5+3';
   } 
   else {
    reportCalculator.innerHTML += visor+' = ';
    document.getElementById('visor').value = eval(document.getElementById('visor').value);
    reportCalculator.innerHTML +=  eval(document.getElementById('visor').value)+', ';
    messageError.innerHTML = 'Calculadora (JS): Por Valdiney França';
  }
 }

//////////////////////////////////////////////////////

/////////////////////////////////////////////////////
// This function clean the visor values
////////////////////////////////////////////////////

var cleanVisor = document.getElementById('limpar').onclick = function(){
  document.getElementById('visor').value = '';
 }



 } // end window