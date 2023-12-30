<?php
session_start();
include("include/koneksyon.php");
$title = "IBM | Accueil";
?>

<?php include_once("include/header.php");?>

	<!-- Bienvenue -->
	<div class="row">
		<div id="welcome" class="col-md-6 text-center">
			<h1 class="text-center"><span>Bienvenu à</span><br>International Business Management</h1>
		</div>

		<div class="col-md-6 text-center">
			<img class="w-50 mt-5 rounded-circle" src="img/man.jpeg">
		</div>	
	</div>
	<!-- Fin de Bienvenue -->

	<hr class="w-75 m-auto my-5">
	<div class="container-fluid px-0 px-lg-5 px-md-5">
	<div class="row">
		<div class="col-md-7 pe-lg-5 pe-md-5 ps-4 pe-4 ps-lg-0 ps-md-0">
			<h4>COMMENT CA MARCHE</h4>
			<p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500
				<ul>
					<li>Programme licence en 2 ans</li>
					<li>Programme diplome en 1 ans</li>
				</ul>
			Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500</p>
			<a style="background: #ff914c;" class="btn text-white mb-5 mb-lg-0 mb-md-0" href="register.php">Inscrivez-vous</a>
		</div>

		<div class="col-md-5">
			<div class="col-md-12">
				<h4 class="float-start">NOTRE EQUIPE</h4>
				<a style="padding: 0 10px; font-size:14px; font-weight:bold; text-decoration: none; color:#ff914c; border:2px solid #ff914c" class="float-end" href="">VOIR PLUS</a>
			</div>
			<div style="clear: both;" class="owl-carousel owl-theme col-md-12">
				<?php 
					$selectteam = $dbConnect->prepare("SELECT * FROM team");
					$selectteam->execute();
					while ($team = $selectteam->fetch()){
				?>
			    <div class="item">
			    	<img src="img/<?=$team["image"];?>">
			    	<h6 class="text-center mt-2"><?=$team["prenom"]." ".$team["nom"];?></h6>
			    	<p class="text-center" style="font-size: 12px; line-height: 12px;"><?=$team["fonction"];?></p>
			    </div>
			<?php } ?>
			</div>
		</div>
	</div>
	</div>

	<!-- Partie pour nos cours -->
	<div class="row px-lg-5 px-md-3 px-0 bg-secondary bg-opacity-25 my-3 py-3">
		<div>
			<h2 class="display-5 text-center">Devenez un professionnel chevroné avec IBM...</h2>
		</div>
		<div class="illustration">
			<?php
				$selectCourse = $dbConnect->prepare("SELECT * FROM courses limit 0,4");
				$selectCourse->execute();
				while ($courses = $selectCourse->fetch()){
			?>
			<div class="item-illustration d-lg-block d-md-block d-none">
				<img class="w-100" src="img/<?=$courses["illustration"];?>">
				<h3 style="text-transform: uppercase; font-size:16px;line-height: 0px; margin-top:15px; font-weight:bolder;"><?=$courses["cours"];?></h3>
				<p class="m-auto"><span>Programme: </span><?=$courses["programme"];?></p>
				<p class="m-auto d-inline me-4"><span>Duree: </span><?=$courses["duree"];?></p>
				<p class="m-auto d-inline"><strong><span>Prix: </span><?=$courses["prix"]." Gourdes";?></strong></p>
			</div>
		<?php } ?>
		
		</div>

		<div class="owl-carousel owl-theme d-lg-none d-md-none d-block">
				<?php
				$selectCourse = $dbConnect->prepare("SELECT * FROM courses");
				$selectCourse->execute();
				while ($courses = $selectCourse->fetch()){
			?>
			<div class=" d-lg-none d-md-none d-block">
				<img class="w-100" src="img/<?=$courses["illustration"];?>">
				<h3 style="text-transform: uppercase; font-size:16px;line-height: 0px; margin-top:15px; font-weight:bolder;"><?=$courses["cours"];?></h3>
				<p class="m-auto"><span>Programme: </span><?=$courses["programme"];?></p>
				<p class="m-auto d-inline me-4"><span>Duree: </span><?=$courses["duree"];?></p>
				<p class="m-auto d-inline"><strong><span>Prix: </span><?=$courses["prix"]." Gourdes";?></strong></p>
			</div>
			<?php } ?>
			</div>
		<a id="see-more-courses" style="background: #ff914c;" class="btn text-white mt-3 w-25 m-auto" href="cours.php">VOIR PLUS DE COURS</a>
	</div>
	<!-- Fin de nos cours -->
	<hr class="w-50 m-auto my-4 d-none d-md-block d-lg-block">

	
	<?php include_once ("include/footer.php");?>


<!-- Fin du Container -->
</div>
</div>

<!-- Partie reservee aux script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	AOS.init();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/cdfdef5996.js" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay:true,
    autoplayTimeout:3000,
    autoplaySpeed: 4000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
          items:3
        }
    }
})
</script>

<script>
const progress_chart = document.getElementById('myChart');
  	var moi = 90;
	var dispo = 100 - moi;
	var reussi = 100 - dispo;

  new Chart(progress_chart, {
    type: 'doughnut',
    data: {
    	labels: ["Progression pour ce cours", "Quantite restante"],
      	datasets: [{
        	label: 'Quantite restante',
        	data: [reussi, dispo],
	    	backgroundColor: [
	      		'green',
	      		'red'
	    	],
    	hoverOffset: 4
      }]
    }
  });
</script>

</body>
</html>