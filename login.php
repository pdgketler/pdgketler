<?php
session_start();
include_once("include/koneksyon.php");

		if (isset($_POST['connectuser'])){
		if (isset($_POST["email"]) && $_POST['email'] != "" && isset($_POST["password"]) && $_POST['password'] != ""){
			$email = trim(htmlspecialchars($_POST['email']));
			$password = trim(htmlspecialchars($_POST['password']));
			$selectuser = $dbConnect->prepare("SELECT * FROM students WHERE email=?");
			$selectuser->execute([$email]);
			$nbruser = $selectuser->rowcount();
			if ($nbruser > 0){
				$user = $selectuser->fetch();
				$pass = $user["password"];
				$pass_verify = password_verify($password, $pass);
				if ($pass_verify > 0){
					$_SESSION['user'] = $user["id"];
					header("Location:dashboard.php");
				}
				else{
					$error = "Informations incorrects.";
				}
			}
			else{
				$error = "Informations incorrects.";
			}
		}
		else{
			$error = "Veuillez remplir tous les champs.";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/mobile.css?=v6" media="screen and (max-width: 767px)">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<title>IBM | Connexion</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div style="cursor:pointer; background: #ff914c; width: 100px; text-align:center; color:white; height: 40px;">
			<p style="font-weight: 600; font-size: 18px;" class="back mt-1">Back</p>
		</div>
			<div id="box-connection" class="w-25 m-auto shadow-lg rounded-4 py-3">
					
					<img style="width: 60%; margin-left:20%; margin-bottom: 15px;" src="img/logoibm.png">
					<hr class="w-50 m-auto">
					<form class="form m-auto" method="POST" action="">
					<?php if (isset($error)) { ?>
						<p class="alert alert-danger"><?=$error;?></p>
					<?php } ?>
						<label class=" mt-2 mb-1 text-secondary" for="email">Email</label>
						<input class="form-control w-100 m-auto border border-secondary border-opacity-50" type="email" name="email">
						<label class=" mt-2 mb-1 text-secondary" for="password">Mot de passe</label>
						<input class="form-control w-100 m-auto border border-secondary border-opacity-50" type="password" name="password">
						<button style="background: #ff914c; font-weight: 600;" class="btn my-3 text-white" name="connectuser">Connecter</button>
						<p class="m-auto text-secondary">Mot de passe oublie? <a href="#">Cliquez-ici</a></p>
						<p class="m-auto text-secondary">Nouveau sur ce site? <a href="register.php">Inscrivez-vous</a></p>	
					</form>
			</div>	
		</div>
	</div>


	<script>
	$(document).ready(function(){
		// Close button
		$(".back").click(function(){
			window.history.back()
		})
	});
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://kit.fontawesome.com/cdfdef5996.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</body>
</html>