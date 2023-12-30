<?php
session_start();
include("include/koneksyon.php");
// get the total number of records
// 		$result = $dbConnect->prepare("SELECT * FROM activities");
// 		$result->execute();
// 		$total_records = $result->rowcount();
// 		$nbr_per_page = 3;

// 		// calculate the total number of pages
// 		$total_pages = ceil($total_records / $nbr_per_page);

// 		// get the current page number
// 		if (!isset($_GET["page"])) {
// 			$current_page = 1;
// 		} else {
// 			$current_page = $_GET["page"];
// 		}

// 		// calculate the offset
// 		$offset = ($current_page - 1) * $nbr_per_page;

// ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css?=v6">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<title>Pratique</title>
</head>
<body>
<!-- Load font awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">






<div class="container my-5">
	<?php	
				$selectElement = $dbConnect->prepare("SELECT * FROM pagecontent");
				$selectElement->execute();
				$row = $selectElement->fetch();
			?>
	<div id="<?=$row["mainDiv"];?>">
		<div class="part1">

			<div class="part1_elements" style="--i:<?=$row["subDiv"];?>">

				<?php 
					$selectActivities = $dbConnect->prepare("SELECT * FROM activities ORDER BY id DESC limit $offset, $nbr_per_page");
					$selectActivities->execute();
					if ($selectActivities->rowcount() > 0) {
					while ($activities = $selectActivities->fetch()){
						// display the records
			
				// while($row = $result->fetch()) {
				?>
				<div class="<?=$row["itemDiv"];?>" style="background-image: url('img/<?=$activities["image"];?>');">
					<div class="vignette"><h3><?=$activities["category"];?></h3></div>
					<img src="img/<?=$activities["image"];?>">
					<h2><?=$activities["titre"];?></h2>
					<p><?=$activities["description"];?></p>
					<h3>Organisateur: <span><?=$activities["organisateur"];?></span></h3>
					<p class="end"><?=$activities["note"];?></p>
				</div>
			<?php } 	}
			// }

			?>
			</div>

			<div class="linkpagination text-center py-5" style="width: 100%;"><?php 
			// display the pagination links
				for ($i = 1; $i <= $total_pages; $i++) {
					if ($current_page != $i){
					echo "<a class=\"links\" href='index.php?page=$i'>$i</a> ";
					}
					else{
						echo "<a class=\"links bg-warning\" href='index.php?page=$i'>$i</a>";
					}
				}

				?>	
			</div>
		</div>		


		<div class="part2"></div>
		
	</div>
<!-- Fin du Container -->
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>