<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin panel</title>
<link rel="stylesheet" href="font awesome/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" 
crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
	<style>
		.header{
			background-color:#0ac0f2;
			display:flex;
			justify-content:space-between;
			padding:10px;
			height:70px;
			align-items:center;
		}
		
		
	</style>

	<div class="header">
		<div class="natpis">
			<h2><strong>Klub Knez</strong></h2>
		</div>
		<div class="batn">
		<button type="button" class="batuncic btn btn-danger">Izloguj se</button>
		</div>
	</div>
	<br>
		<div class="container">
	<div class="row justify-content-center">
	
		<div class="col-sm-10">
		<table class="table table-dark">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Ime</th>
			  <th scope="col">Prezime</th>
			  <th scope="col">Email</th>
			  <th scope="col">Datum zurke</th>
			  <th scope="col">Od</th>
			  <th scope="col">Do</th>
			  <th scope="col">Vrsta zurke</th>
			</tr>
		  </thead>
		  <tbody id="gle">
			
		  </tbody>
		  
		</table>


		</div>

		
	</div>
			
		</div>
		
	</div>


<div class="modal" id="izbrisiRez" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure that you want to delete reservation?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close2" data-dismiss="modal">Close</button>
        <button type="button" class="izbrisi btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

	
</body>

<script type="text/javascript">
$(document).ready(function(){

	var id = 0;

	
	$(".batuncic").click(function(e){
		//e.preventDefault();
		//alert("cao!");
		
		window.location.href = "index.html";
		
	});	

	$(".close").click(function(){
		$("#izbrisiRez").hide();
	});

	$("#close2").click(function(){
		$("#izbrisiRez").hide();
	});



	$(".izbrisi").click(function(){
			
		$.ajax({
				url:"izbrisi_admin.php",
				type:"POST",
				data:{id:id},
				dataType:"xml",
				success:function(podaci){

				alert("Uspesno ste obrisali rezervaciju!");
				$("#izbrisiRez").hide();
				Prikazi();

    			},
				error:function(){
					alert("greska!");
				}
		});

	});

	Prikazi();

		function Prikazi(){

		$("#gle").empty();
		
		$.ajax({
			url:"prikaz_admin.php",
			type:"POST",
			data:{
				prenos:"citanje"
			},
			dataType:"xml",
			success:function(podatak){
				
				$(podatak).find("prikaz").each(function(){

					var idXML = $(this).find('id_podaci').text();
					var imeXML = $(this).find("ime").text();
					var prezimeXML = $(this).find("prezime").text();
					var emailXML = $(this).find("email").text();
					var datum_zurkeXML = $(this).find("datum_zurke").text();
					var odXML = $(this).find("vreme_zurke_od").text();
					var doXML = $(this).find("vreme_zurke_do").text();
					var vrsta_zurkeXML = $(this).find("vrsta_zurke").text();
					
					$("#gle").append('<tr><th scope=row><i class="fas fa-user"></i></th><td>'+imeXML+'</td><td>'+prezimeXML+'</td><td>'+emailXML+'</td><td>'+datum_zurkeXML+'</td><td>'+odXML+'</td><td>'+doXML+'</td><td>'+vrsta_zurkeXML+'</td><td><button id='+idXML+' class="delete btn btn-danger">Izbriši</button></td></tr>');
					
					$(".delete").click(function(){
						id = $(this).attr("id");
						$("#izbrisiRez").show();
					});
					
				});
			},
			error:function(){
				alert("greska!");
				}
			});
		}
	
});		
</script>

</html>