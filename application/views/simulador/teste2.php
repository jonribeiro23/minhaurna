<link href="<?= base_url('public/css/simulador-teste.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url('public/css/virtual-key.css')?>">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>

<div class="row">
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
	<div class="col-sm-10 col-md-8 col-lg-4 align-middle" align="center">
		<div class="card ">
			<img src="..." class="card-img-top" alt="...">
			<div class="card-body">
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			</div>
		</div>
	</div>
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
</div>

<div class="row" align="center">
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
	<div class="col-sm-10 col-md-8 col-lg-4 align-middle" align="center">
		<!-- teclado -->
		<div class="">
			
			
			
			<div class="teclado2">
				<button class="branco  click">BRANCO</button>
				<button class="laranja  click">CORRIGE</button>
				<button class="verde">CONFIRMA</button>
			</div>
		</div>
		<!-- /teclado -->
	</div>
	<div class="col-sm-1 col-md-2 col-lg-4"></div>
</div>


<script>
	window.onload = function() {
		let txtSize = document.querySelectorAll('p')
		let btnSize = document.querySelectorAll('.btn')
		
		if (screen.width < 740 || screen.height < 480) { 

			txtSize.forEach(e => {
				e.style.fontSize = '2.9em'
			})

			btnSize.forEach(e => {
				e.style.fontSize = '2.9em'
			})

		} else {
			txtSize.forEach(e => {
				e.style.fontSize = '1.2em'
			})
		
		}
	}

	// var x = window.matchMedia("(max-width: 800.98px)")
	// myFunction(x) // Call listener function at run time
	// x.addListener(myFunction) // Attach listener function on state changes 
</script>


<script>
	$(document).ready(function(){
	$('.table_teclado tr td').click(function(){
		var number = $(this).text();
		
		if (number == '')
		{
			$('#campo').val($('#campo').val().substr(0, $('#campo').val().length - 1)).focus();
		}
		else
		{
			$('#campo').val($('#campo').val() + number).focus();
		}

	});
});
</script>