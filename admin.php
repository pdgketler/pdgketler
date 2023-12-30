<?php
session_start();
include_once("include/koneksyon.php");
if (!isset($_SESSION["admin"])) {
	header("Location:loginadm.php");
}
include_once("include/team_process.php");
include_once("include/students_process.php");
include_once("include/courses_process.php");
include_once("include/seance_process.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/admin.css?v=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<title>IBM | admin</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div style="position: fixed;" class=" shadow left-box col-md-2">
				<img class="logo" src="img/logoibm.png">
				<h2>Administration</h2>
				<div class="menu">												
					<img class="icon" src="img/adm.png"><a href="admin.php?page=1">Admistrateurs</a>
				</div>
				<div class="menu">				
					<img class="icon" src="img/team.png"><a href="admin.php?page=2">Notre Equipe</a>
				</div>
				<div class="menu">
					<img class="icon" src="img/courses.png"><a href="admin.php?page=3">Nos cours</a>
				</div>
				<hr>
				<div class="menu">
					<img class="icon" src="img/browser2.png"><a href="admin.php?page=4">Pages</a>
				</div>
				<hr>

				<h2>Etudiants</h2>
				<div class="menu">
					<img class="icon" src="img/user.png"><a href="admin.php?page=5">Informations</a>
				</div>
				<div class="menu">
					<img class="icon" src="img/result.png"><a href="admin.php?page=6">Bulletin</a>
				</div>
				<hr>
				<div class="menu">
					<img class="icon" src="img/partner.png"><a href="admin.php?page=7">Nos partenaires</a>
				</div>
				<hr>
				<div class="menu">
					<img class="icon" src="img/seance.png"><a href="admin.php?page=8">Seances</a>
				</div>
				<hr>
				<div class="menu">
					<img class="icon" src="img/logout.png"><a href="admdeconnect.php">Deconnexion</a>
				</div>
			</div>
			<div class="col-md-2"></div>

			<div class="right-box col-md-10 ps-4">
					<div class="navigation shadow-sm">
						<div class="infos">
							<?php if (isset($_SESSION['admin'])){
								$id = $_SESSION['admin'];
								$user = $dbConnect->prepare("SELECT * FROM team WHERE id=?");
								$user->execute([$id]);
								$selectUser = $user->fetch();?>
							<img src="img/<?=$selectUser["image"];?>">
							<p><?=$selectUser["prenom"]." ".$selectUser["nom"];?></p>
						<?php } ?>
						</div>
					</div>
					<?php
					if(isset($_GET["page"])){
							include_once ("include/administrators.php");
							include_once ("include/team.php");
							include_once ("include/students.php");
							include_once ("include/courses.php");
							include_once ("include/seance.php");			
					}
						else{ ?>
							<img style="width: 60%; margin-left:20%; margin-top:10vh;" src="img/logoibm.png">
						<?php }
					?>
			</div>

			
		</div>
	</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://kit.fontawesome.com/cdfdef5996.js" crossorigin="anonymous"></script>
</body>
</html>