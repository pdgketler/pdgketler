<?php
session_start();
include("include/koneksyon.php");
if (isset($_SESSION['user'])){
	header("Location:dashboard.php");
}
$title = "IBM | Inscription";

	if (isset($_POST['register'])){
		if ($_POST['nom'] != "" && $_POST['prenom'] != "" && $_POST['datenaissance'] != "" && $_POST['lieunaissance'] != "" && $_POST['sexe'] != "" && $_POST['nationalite'] != "" && $_POST['email'] != "" && $_POST['telephone'] != "" && $_POST['reference'] != "" && $_POST['pays'] != "" && $_POST['adresse'] != "" && $_POST['adressepostale'] != "" && $_POST['password'] != "" && $_POST['passwordconfirm'] != ""){
			$nom = trim(htmlspecialchars($_POST['nom']));
			$prenom = trim(htmlspecialchars($_POST['prenom']));
			$datenaissance = trim(htmlspecialchars($_POST['datenaissance']));
			$lieunaissance = trim(htmlspecialchars($_POST['lieunaissance']));
			$sexe = trim(htmlspecialchars($_POST['sexe']));
			$nationalite = trim(htmlspecialchars($_POST['nationalite']));
			$email = trim(htmlspecialchars($_POST['email']));
			$telephone = trim(htmlspecialchars($_POST['telephone']));
			$reference = trim(htmlspecialchars($_POST['reference']));
			$pays = trim(htmlspecialchars($_POST['pays']));
			$adresse = trim(htmlspecialchars($_POST['adresse']));
			$adressepostale = trim(htmlspecialchars($_POST['adressepostale']));
			$password = trim(htmlspecialchars($_POST['password']));
			$passwordconfirm = trim(htmlspecialchars($_POST['passwordconfirm']));
			if ($password == $passwordconfirm){
				$password2 = password_hash($password, PASSWORD_DEFAULT);
				$selectStudent = $dbConnect->prepare("SELECT * FROM students WHERE email=?");
				$selectStudent->execute([$email]);
				$nbr = $selectStudent->rowcount();
				if ($nbr == 0){
					$imageFiled = "image";
					$imageName = $_FILES[$imageFiled]["name"];
					$tempName = $_FILES[$imageFiled]["tmp_name"];
					if (!empty($imageName)){
						$imageNameDivided = explode(".", $imageName);
						$imageType = $_FILES[$imageFiled]["type"];
						$imageExt = strtolower(end($imageNameDivided));
						if (in_array($imageExt, ["png", "jpg", "jpeg"])){
							$newName = time().".".$imageExt;
							$destination = "img/".$newName;
							move_uploaded_file($tempName, $destination);

							$insertStudent = $dbConnect->prepare("INSERT INTO `students`(`nom`, `prenom`, `datenaissance`, `lieunaissance`, `sexe`, `nationalite`, `email`, `telephone`, `reference`, `pays`, `adresse`, `adressepostale`, `password`, `image`) VALUES (:nom, :prenom, :datenaissance, :lieunaissance, :sexe, :nationalite, :email, :telephone, :reference, :pays, :adresse, :adressepostale, :password, :image)");
							$insertStudent->execute(["nom"=>$nom, "prenom"=>$prenom, "datenaissance"=>$datenaissance, "lieunaissance"=>$lieunaissance, "sexe"=>$sexe, "nationalite"=>$nationalite, "email"=>$email, "telephone"=>$telephone, "reference"=>$reference, "pays"=>$pays, "adresse"=>$adresse, "adressepostale"=>$adressepostale, "password"=>$password2, "image"=>$newName]);

							$students = $dbConnect->prepare("SELECT * FROM students WHERE email=?");
							$students->execute([$email]);
							$nbrs = $students->rowcount();
							if ($nbrs > 0){
								$user = $students->fetch();
								$_SESSION['user'] = $user["id"];
								header("Location:dashboard.php");
							}

						}
						else{
							$error = "Seules les images de format png, jpg, jpeg sont acceptees.";
						}

					}
					else{
						$error = "Veuillez remplir tous les champs.";
					}
				}
				else{
					$error = "Email deja enregistre.";
				}

			}
			else{
				$error = "Vos mots de passe ne correpondent pas.";
			}

		}
		else{
			$error = "Veuiller ramplir tous les champs.";
		}
	}
?>

<?php include_once("include/header.php"); ?>

<?php 
	if (isset($_GET['page'])){ ?>
		<div style="position:absolute; top:0; left:0; width: 100%; min-height: 200vh; background: rgba(255, 255, 255, 1.0); z-index: 1000;">
			<?php include_once ("include/theme_condition.php");?>
		</div>

	<?php } ?>

	<hr id="bar" class="w-75 m-auto my-5">
	<div class="container-fluid px-1 px-lg-5 px-md-3">
		<div class="row">
			<div class="col-md-6 pe-lg-5">
				<video class="w-100" autoplay controls muted>
					<source src="video/pub.mkv" type="video/mp4">
				</video>
				<h4>TERMES ET CONDITIONS</h4>
				<p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500
					<ul>
						<li>Programme licence en 2 ans</li>
						<li>Programme diplome en 1 ans</li>
					</ul>
				Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500</p>
				<a style="background: #ff914c;" class="btn text-white mb-5 mb-md-0 mb-lg-0" href="register.php">Inscrivez-vous</a>
			</div>

			<div class="col-md-6">
				<div class="col-md-12">
					<h4>FORMULAIRE D'INSCRIPTION</h4>
				</div>

				<form class="form mb-4 border rounded p-3" method="POST" action="" enctype="multipart/form-data">
					<?php if (isset($error)) { ?>
						<p class="alert alert-danger"><?=$error;?></p>
					<?php } ?>
					<div class="row">
						<div class="col-md-12">
						<h2 style="font-size: 16px; background: #ff914c;" class="rounded-2 rounded p-2 bg-gradient text-light">INFORMATIONS PERSONNELLES</h2>
						</div>
						<div class="col-md-12">
							<label for="image">Profil:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="file" name="image" id="image" value="profil.png" required>
						</div>
						<div class="col-md-6">
							<label for="nom">Nom:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="nom" id="nom" required>
						</div>
						<div class="col-md-6">
							<label for="prenom">Prenom:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="prenom" id="prenom" required>
						</div>
						<div class="col-md-6 col-6 col-lg-6 mt-2">
							<label for="datenaissance">Date de naissance:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="date" name="datenaissance" id="datenaissance" required>
						</div>
						<div class="col-md-6 col-6 col-lg-6 mt-2">
							<label for="lieunaissance">Lieu de naissance:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="lieunaissance" id="lieunaissance" required>
						</div>
						<div class="col-md-6 col-6 col-lg-6 mt-2">
							<label for="sexe">Sexe:</label>
							<div class="form-control bg-secondary bg-opacity-10">
								<input  type="radio" name="sexe" id="masculin" value="Masculin">
								<label class="me-3 me-md-5 me-lg-5" for="masculin">Masculin</label>
								<input  type="radio" name="sexe" id="feminin" value="Feminin">
								<label for="feminin">Feminin</label>
							</div>
						</div>
						<div class="col-md-6 col-6 col-lg-6 mt-2">
							<label for="nationalite">Nationalite:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="nationalite" id="nationalite" required>
						</div>
						<div class="col-md-6 mt-2">
							<label for="email">Email:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="email" name="email" id="email" required>
						</div>
						<div class="col-md-6 mt-2">
							<label for="telephone">Telephone:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="telephone" id="telephone" required>
						</div>
						<div class="col-md-6 mt-2">
							<label for="reference">Telephone de reference:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="reference" id="reference" required>
						</div>
						<div class="col-md-6 mt-2">
							<label for="pays">Pays de residence:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="pays" id="pays" required>
						</div>
						<div class="col-md-12 mt-2">
							<label for="adresse">Adresse actuel:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="adresse" id="adresse" required>
						</div>
						<div class="col-md-12 mt-2">
							<label for="adressepostale">Adresse postale:</label>
							<input class="form-control bg-secondary bg-opacity-10" type="text" name="adressepostale" id="adressepostale" required>
						</div>
						<div class="col-md-6 col-6 col-lg-6 mt-2">
							<label for="password">Mot de passe</label>
							<input class="form-control bg-secondary bg-opacity-10" type="password" name="password" id="password" required>
						</div>
						<div class="col-md-6 col-6 col-lg-6 mt-2">
							<label for="passwordconfirm">Confirmez le Mot de passe</label>
							<input class="form-control bg-secondary bg-opacity-10" type="password" name="passwordconfirm" id="passwordconfirm" required>
						</div>
						<a class="mt-4" href="register.php?page=1">Themes et conditions.</a>
						
						<div class="col-md-12 col-12 col-lg-12 mt-2">
							<input  class="d-inline" type="checkbox" name="accord" id="accord" value="accord" required>
							<label class="d-inline" for="accord">J'atteste avoir bien lu les themes et conditions de l'institution IBM.</label>
						</div>
						
						<button style="background: #ff914c; color:white; font-weight:600;" type="submit" name="register" class="btn w-25 m-auto mt-3">S'inscrire</button>
					</div>
				</form>
			
			</div>
		</div>
	</div>


	
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