<?php
session_start();
include("include/koneksyon.php");
$title = "IBM | Cours";
if (isset($_POST['enroll']) && isset($_SESSION['user'])){
	$id = $_SESSION['user'];
	$selectuser = $dbConnect->prepare("SELECT * FROM students WHERE id=?");
	$selectuser->execute([$id]);
	$user = $selectuser->fetch();
	$etudiant = $user["prenom"]." ".$user["nom"];
	if ($_POST['cours'] != ""){
		$cours = trim(htmlspecialchars($_POST['cours']));
		$chosencourse = $dbConnect->prepare("INSERT INTO `coursechosen`(`etudiant`, `cours`) VALUES (:etudiant, :cours)");
		$chosencourse->execute(["etudiant"=>$etudiant, "cours"=>$cours]);

		$message = "Choix reussi";
	}
}
?>

<?php include_once("include/header.php"); ?>

	<!-- Partie pour nos cours -->
	<div id="cours" class="row px-5 bg-secondary bg-opacity-25 my-3 py-3">
		<div class="col-md-12">
			<div>
				<h2 class="display-5 text-center">Devenez un professionnel chevroné avec IBM...</h2>
				<?php
					if (isset($message)){ ?>
						<div class="alert alert-success w-10 m-auto"><p class="m-auto"><?=$message;?></p></div>
				<?php } ?>
			</div>
			<div class="illustration">
				<?php
					$selectCourse = $dbConnect->prepare("SELECT * FROM courses limit 0,4");
					$selectCourse->execute();
					while ($courses = $selectCourse->fetch()){
				?>
				<div class="item-illustration">
					<img class="w-100" src="img/<?=$courses["illustration"];?>">
					<h3 style="text-transform: uppercase; font-size:16px;line-height: 0px; margin-top:15px; font-weight:bolder;"><?=$courses["cours"];?></h3>
					<p class="m-auto"><span>Programme: </span><?=$courses["programme"];?></p>
					<p class="m-auto d-inline me-4"><span>Duree: </span><?=$courses["duree"];?></p>
					<p class="m-auto d-inline"><strong><span>Prix: </span><?=$courses["prix"]." Gourdes";?></strong></p>
					<?php
					if (isset($_SESSION['user'])) { ?>
						<form method="POST" action="">
							<input type="hidden" name="cours" value="<?=$courses["cours"];?>">
							<button style="background: #ff914c; font-weight:600" class="btn mt-3 text-white" type="submit" name="enroll">Suivez ce cours</button>
						</form>

					<?php } ?>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
	<!-- Fin de nos cours -->



<?php include_once ("include/footer.php");?>
<!-- Fin du Container -->
</div>
</div>

<!-- Partie reservee aux script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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

</body>
</html>