<?php
session_start();
include("include/koneksyon.php");
if (!isset($_SESSION['user'])){
	header("Location:index.php");
}
else{
	$id = $_SESSION['user'];
	$selectUser = $dbConnect->prepare("SELECT * FROM students WHERE id=?");
	$selectUser->execute([$id]);
	$user = $selectUser->fetch();
	$title = "IBM | ".$user["prenom"]." ".$user["nom"];
}
?>

<?php include_once("include/header.php"); ?>



	<div class="row mt-5">
		<div class="d-lg-none d-md-none d-block" style="margin-top:30px;"></div>
		<hr class="w-75 m-auto d-block d-lg-none d-md-none my-4">

		<!-- Liste des cours choisis et Modalite -->

<!-- Pour grands ecran -->

		<div style="overflow: hidden;" class="col-md-2 col-lg-2 d-lg-block d-md-block d-none">
			<h4 class="btn text-white mb-3 form-control" style="margin-left: 10px; background: #ff914c; cursor:auto;">Mes cours</h4>
			<?php
				if (isset($_SESSION['user'])){
				$id = $_SESSION['user'];
				$selectuser = $dbConnect->prepare("SELECT * FROM students WHERE id=?");
				$selectuser->execute([$id]);
				$user = $selectuser->fetch();
				$etudiant = $user["prenom"]." ".$user["nom"];
				$selectcourse = $dbConnect->prepare("SELECT * FROM coursechosen WHERE etudiant=?");
				$selectcourse->execute([$etudiant]);
				echo "<ul class='list-unstyled'>";
				while ($courses = $selectcourse->fetch()){ ?>
					<li style="margin-left: 10px; background:rgba(0, 0, 0, 0.1); padding:10px; border-radius:10px;" class="mb-3 form-control"><a style="text-decoration: none; color:black;" href="dashboard.php?cours=<?=$courses["cours"];?>"><?=$courses["cours"];?></a></li>

				<?php } echo "</ul>";
			}?>
			<hr class="w-50 m-auto mb-2">
			<div class=" ms-2 ">
				<h4 style="margin-left: 0px;">Modalite</h4>
				<p style="margin-left: 0px;">Vous devez payer 50% du montant demande avant de pouvoir suivre la quatrieme seance, 40% doit etre verse avant la dixieme seance et l'autre 10% avant la fin du cours.</p>
			</div>	
		</div>
		<!-- Fin grands ecrans -->

<!-- Pour ecran telephone -->

	<div class="navbar navbar-expand-lg mb-5 w-100 d-lg-none d-md-none d-block">

				<button style="position: absolute; top:5px; left: 20px; z-index:0; background:#ff914c; border:none;padding: 5px 15px;" data-bs-toggle="collapse" data-bs-target="#moi2">
					<span style="color:white;">Mes Cours</span>
				</button>

		<div style="overflow: hidden; padding:30px 50px; min-height:100vh; background:white; position: absolute; top:40px; z-index:100" class="collapse" id="moi2">
			<!-- <h4 class="btn text-white mb-3 text-center" style="background: #ff914c; cursor:auto;">Mes cours</h4> -->
			<?php
				if (isset($_SESSION['user'])){
				$id = $_SESSION['user'];
				$selectuser = $dbConnect->prepare("SELECT * FROM students WHERE id=?");
				$selectuser->execute([$id]);
				$user = $selectuser->fetch();
				$etudiant = $user["prenom"]." ".$user["nom"];
				$selectcourse = $dbConnect->prepare("SELECT * FROM coursechosen WHERE etudiant=?");
				$selectcourse->execute([$etudiant]);
				echo "<ul class='list-unstyled'>";
				while ($courses = $selectcourse->fetch()){ ?>
					<li style="margin-left: 10px; background:rgba(0, 0, 0, 0.1); padding:10px; border-radius:10px;" class="mb-3 form-control"><a style="text-decoration: none; color:black;" href="dashboard.php?cours=<?=$courses["cours"];?>"><?=$courses["cours"];?></a></li>

				<?php } echo "</ul>";
			}?>
			<hr class="w-50 m-auto mb-2">
			<div class=" ms-2 ">
				<h4 style="margin-left: 0px;">Modalite</h4>
				<p style="margin-left: 0px;">Vous devez payer 50% du montant demande avant de pouvoir suivre la quatrieme seance, 40% doit etre verse avant la dixieme seance et l'autre 10% avant la fin du cours.</p>
			</div>	
		</div>
	</div>
	<!-- Fin ecran telephone -->

		<!-- Mots d'encouragement et Visionnage de seances -->

		<div class="col-md-6 px-3 px-lg-5 px-md-5 mt-2 mt-md-0 mt-lg-0">
			<?php
			$id = $_SESSION['user'];
				$selectUser = $dbConnect->prepare("SELECT * FROM students WHERE id=?");
				$selectUser->execute([$id]);
				$user = $selectUser->fetch();

			if (isset($_GET['page'])){
				if ($user["acces"] == 0){ ?>
					<div class="alert alert-danger">
						<p class="m-auto">Vous n'avez pas acces a ce cours, veuillez contacter l'administration de l'IBM pour remedier a cela</p>
					</div>

				<?php }
				else{
					include_once("include/seance_video.php");
				}
			}
			else {
				if (isset($_GET['cours'])){ ?>
					<div class="d-none d-lg-block d-md-block">
						<h2>Bonjour, <?=$user["prenom"]." ".$user["nom"];?></h2>
				<p>Praesent tempor tellus eu lobortis fermentum. Morbi vel lectus a mi dapibus faucibus. Aenean eget lacus placerat, pretium mi quis, viverra sem. Aenean pharetra odio urna, ut dignissim arcu lobortis id. Cras gravida ligula ac egestas mattis. Sed cursus velit pretium dignissim dapibus. Proin in volutpat leo. Quisque blandit vehicula nisi, et eleifend dui convallis quis.<br><br>

				Nunc tempor eleifend arcu in convallis. Cras id ex eu ligula vestibulum pharetra. Quisque massa ante, dapibus quis mattis a, dapibus sit amet quam. Etiam orci risus, molestie vitae suscipit nec, pretium ac tellus. Donec efficitur imperdiet ligula, a egestas urna facilisis suscipit. Nunc et blandit justo. Sed tempor faucibus arcu, eu bibendum enim cursus sed. Aliquam luctus ipsum eget cursus accumsan.<br>
				<hr class="w-50 m-auto mb-3">

				Maecenas imperdiet, urna vitae imperdiet bibendum, risus metus ornare tortor, eget facilisis ex turpis a lectus. Aenean sed tincidunt quam. Nam facilisis iaculis eros. Sed non nisl augue. Quisque id ultricies elit. Suspendisse eu faucibus mi. Cras justo risus, porta vitae sapien eget, lobortis semper dui.<br><br>

				<?=$user["prenom"];?>, Duis elementum vestibulum velit. Donec massa justo, porttitor vitae dignissim ut, consequat condimentum tortor. Etiam lobortis facilisis posuere. Maecenas eget arcu egestas, luctus ante at, semper arcu. Mauris quis interdum eros, a commodo purus. Suspendisse gravida felis sit amet ex maximus facilisis. Phasellus a mattis arcu, at blandit tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus.<br><br>

				Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam ac purus sit amet ipsum luctus porta ac et justo. Sed consequat, eros quis convallis convallis, felis quam blandit nisl, quis fringilla ipsum mauris quis eros. Quisque et semper augue, eu commodo risus. Quisque dictum fringilla justo vel interdum. Donec pharetra metus et diam tincidunt feugiat. Etiam euismod purus nec dui faucibus molestie. Quisque elit augue, volutpat eget enim eget, tempus pharetra ipsum. Nunc vitae blandit libero, non fringilla arcu. Vivamus ornare iaculis congue. In molestie quis augue id ullamcorper. Ut nec diam id dolor bibendum blandit. Nullam libero nibh, tempor id tempor vitae, blandit vitae augue. Nam venenatis magna nec volutpat vestibulum. Duis fermentum lectus non nisi accumsan cursus quis non diam. Curabitur bibendum faucibus feugiat.<br><br>

				Fusce ultrices, orci sollicitudin placerat auctor, felis turpis blandit libero, sed fermentum urna tellus sit amet nulla. Donec luctus, nisi rhoncus sagittis finibus, massa neque elementum metus, a vehicula enim massa iaculis velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nulla purus, commodo et diam quis, porta tempus sapien. Nam suscipit placerat metus, sed luctus dolor vestibulum et. Nunc imperdiet aliquet faucibus. Nulla sit amet lobortis nulla. Nam at magna ligula. Quisque condimentum, dui condimentum porttitor dictum, magna nibh accumsan turpis, at commodo libero magna ut ligula. Quisque placerat malesuada sagittis. Curabitur ultrices fermentum dolor. Phasellus commodo libero vitae lacinia tincidunt. Integer a cursus lorem. Proin nisi justo, vehicula vel lectus sed, placerat semper nunc.<br><br>
				<hr class="w-50 m-auto mb-3">
				Praesent condimentum eu neque sed suscipit. Sed ornare eleifend mattis. Nulla enim augue, bibendum id accumsan accumsan, rutrum faucibus diam. Sed ac sapien sagittis, congue quam non, condimentum ipsum. Pellentesque bibendum suscipit est. Nullam consectetur vehicula neque at sagittis. Phasellus aliquam eros scelerisque ipsum volutpat consectetur. Ut lacinia risus id lectus luctus consequat</p>
					</div>

					<?php
				}
				else{

					?>
				<h2>Bonjour, <?=$user["prenom"]." ".$user["nom"];?></h2>
				<p>Praesent tempor tellus eu lobortis fermentum. Morbi vel lectus a mi dapibus faucibus. Aenean eget lacus placerat, pretium mi quis, viverra sem. Aenean pharetra odio urna, ut dignissim arcu lobortis id. Cras gravida ligula ac egestas mattis. Sed cursus velit pretium dignissim dapibus. Proin in volutpat leo. Quisque blandit vehicula nisi, et eleifend dui convallis quis.<br><br>

				Nunc tempor eleifend arcu in convallis. Cras id ex eu ligula vestibulum pharetra. Quisque massa ante, dapibus quis mattis a, dapibus sit amet quam. Etiam orci risus, molestie vitae suscipit nec, pretium ac tellus. Donec efficitur imperdiet ligula, a egestas urna facilisis suscipit. Nunc et blandit justo. Sed tempor faucibus arcu, eu bibendum enim cursus sed. Aliquam luctus ipsum eget cursus accumsan.<br>
				<hr class="w-50 m-auto mb-3">

				Maecenas imperdiet, urna vitae imperdiet bibendum, risus metus ornare tortor, eget facilisis ex turpis a lectus. Aenean sed tincidunt quam. Nam facilisis iaculis eros. Sed non nisl augue. Quisque id ultricies elit. Suspendisse eu faucibus mi. Cras justo risus, porta vitae sapien eget, lobortis semper dui.<br><br>

				<?=$user["prenom"];?>, Duis elementum vestibulum velit. Donec massa justo, porttitor vitae dignissim ut, consequat condimentum tortor. Etiam lobortis facilisis posuere. Maecenas eget arcu egestas, luctus ante at, semper arcu. Mauris quis interdum eros, a commodo purus. Suspendisse gravida felis sit amet ex maximus facilisis. Phasellus a mattis arcu, at blandit tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus.<br><br>

				Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam ac purus sit amet ipsum luctus porta ac et justo. Sed consequat, eros quis convallis convallis, felis quam blandit nisl, quis fringilla ipsum mauris quis eros. Quisque et semper augue, eu commodo risus. Quisque dictum fringilla justo vel interdum. Donec pharetra metus et diam tincidunt feugiat. Etiam euismod purus nec dui faucibus molestie. Quisque elit augue, volutpat eget enim eget, tempus pharetra ipsum. Nunc vitae blandit libero, non fringilla arcu. Vivamus ornare iaculis congue. In molestie quis augue id ullamcorper. Ut nec diam id dolor bibendum blandit. Nullam libero nibh, tempor id tempor vitae, blandit vitae augue. Nam venenatis magna nec volutpat vestibulum. Duis fermentum lectus non nisi accumsan cursus quis non diam. Curabitur bibendum faucibus feugiat.<br><br>

				Fusce ultrices, orci sollicitudin placerat auctor, felis turpis blandit libero, sed fermentum urna tellus sit amet nulla. Donec luctus, nisi rhoncus sagittis finibus, massa neque elementum metus, a vehicula enim massa iaculis velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque nulla purus, commodo et diam quis, porta tempus sapien. Nam suscipit placerat metus, sed luctus dolor vestibulum et. Nunc imperdiet aliquet faucibus. Nulla sit amet lobortis nulla. Nam at magna ligula. Quisque condimentum, dui condimentum porttitor dictum, magna nibh accumsan turpis, at commodo libero magna ut ligula. Quisque placerat malesuada sagittis. Curabitur ultrices fermentum dolor. Phasellus commodo libero vitae lacinia tincidunt. Integer a cursus lorem. Proin nisi justo, vehicula vel lectus sed, placerat semper nunc.<br><br>
				<hr class="w-50 m-auto mb-3">
				Praesent condimentum eu neque sed suscipit. Sed ornare eleifend mattis. Nulla enim augue, bibendum id accumsan accumsan, rutrum faucibus diam. Sed ac sapien sagittis, congue quam non, condimentum ipsum. Pellentesque bibendum suscipit est. Nullam consectetur vehicula neque at sagittis. Phasellus aliquam eros scelerisque ipsum volutpat consectetur. Ut lacinia risus id lectus luctus consequat</p>
				
			<?php } }?>	
		</div>

		<!-- Liste des seances Pret a etre visione -->

		<div class="col-md-4 px-lg-0 px-md-0 px-5" id="seance">
			<?php
				if (isset($_GET['cours'])){
					$cours = $_GET['cours'];
				
			$selectseances = $dbConnect->prepare("SELECT * FROM seances WHERE cours=?");
			$selectseances->execute([$cours]);?>
				<h5><?=strtoupper($cours);?></h5>

			<?php
			while ($seance = $selectseances->fetch()) { ?>
				<div class="row mb-1 bg-secondary bg-opacity-25 bg-gradiant me-lg-3 me-md-3 py-2 rounded rounded-3">
					<a class="w-100" style="display: block; text-decoration:none; color: black;" href="dashboard.php?page=1&&cours=<?=$seance["cours"];?>&&id=<?=$seance["id"];?>">
							<img style="width: 80px" class="float-start me-2 m-auto rounded rounded-3" src="img/<?=$seance["label"];?>">
							<h2 style="font-size:14px;" class="m-auto"><?=$seance["seance"];?></h2>
							<h2 style="font-size:18px;" class="m-auto"><?=$seance["titre"];?></h2>
							<p class="m-auto"><?=$seance["description"];?></p>
					</a>
				</div>

			<?php } }
			else{
				$selectseances = $dbConnect->prepare("SELECT * FROM seances limit 0, 1");
				$selectseances->execute();
				while ($seance = $selectseances->fetch()) { ?>
					<div class="row mb-1 me-3 py-2 rounded rounded-3">
							<video class="w-75 m-auto" autoplay muted>
								<source src="video/<?=$seance["video"];?>" type="video/mp4">
							</video>
					</div>
				
			<?php } ?>

			<!-- Chart de progression -->

			<div class="w-75 m-auto mt-5">
			  <canvas id="myChart"></canvas>
			</div>
			<?php } ?>	
		</div>
	</div>


<?php include_once ("include/footer.php");?>

<!-- Fin du div de class all -->
</div>
<!-- Fin du Container -->
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