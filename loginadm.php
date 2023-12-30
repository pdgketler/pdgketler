<?php
session_start();
include_once("include/koneksyon.php");

	if (isset($_POST['connectadm'])){
		if (isset($_POST["username"]) && $_POST['username'] != "" && isset($_POST["password"]) && $_POST['password'] != ""){
			$username = trim(htmlspecialchars($_POST['username']));
			$password = trim(htmlspecialchars($_POST['password']));
			$selectadm = $dbConnect->prepare("SELECT * FROM team WHERE username=?");
			$selectadm->execute([$username]);
			$nbruser = $selectadm->rowcount();
			if ($nbruser > 0){
				$adm = $selectadm->fetch();
				$pass = $adm["password"];
				$pass_verify = password_verify($password, $pass);
				if ($pass_verify > 0){
					$_SESSION['admin'] = $adm["id"];
					header("Location:admin.php");
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
	<link rel="stylesheet" type="text/css" href="css/admin.css?v=8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<title>IBM | Connexion</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="w-25 m-auto shadow-lg rounded-4 pt-3">
					
					<img style="width: 60%; margin-left:20%; margin-bottom: 15px;" src="img/logoibm.png">
					<hr class="w-50 m-auto">
					<?php
					if (isset($error)){?>
						<p style="line-height:6px" class="alert alert-danger mt-3 p-auto"><?=$error;?></p>
						<hr class="w-50 m-auto">
					<?php } ?>

					<form class="form m-auto" method="POST" action="">
						<label class=" mt-2 mb-1 text-secondary" for="username">Nom d'utilisateur</label>
						<input class="form-control w-100 m-auto border border-secondary border-opacity-50" type="text" name="username" id="username">
						<label class=" mt-2 mb-1 text-secondary" for="password">Mot de passe</label>
						<input class="form-control w-100 m-auto border border-secondary border-opacity-50" type="password" name="password" id="password">
						<button style="background: #ff914c; font-weight: 600;" class="btn my-3 text-white" name="connectadm">Connecter</button>	
					</form>
			</div>	
		</div>
	</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://kit.fontawesome.com/cdfdef5996.js" crossorigin="anonymous"></script>
</body>
</html>