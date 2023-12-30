<?php
session_start();
include("include/koneksyon.php");
if (isset($_POST['upload'])){
$videofield = "file";
$videoName = $_FILES[$videofield]["name"];
	$target_dir = "video/";
	$target_file = $target_dir . basename($_FILES[$videofield]["name"]);
	$uploadOk = 1;
	$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if file already exists
	if (file_exists($target_file)) {
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}

	// Check file size
	if ($_FILES[$videofield]["size"] > 50000000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($videoFileType != "mp4" && $videoFileType != "mkv" && $videoFileType != "mov"
	&& $videoFileType != "wmv" ) {
	  echo "Sorry, only MP4, AVI, MOV & WMV files are allowed.";
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES[$videofield]["tmp_name"], $target_file)) {
	    echo "The file ". htmlspecialchars( basename( $_FILES[$videofield]["name"])). " has been uploaded.";
	  } else {
	    echo "Sorry, there was an error uploading your file.";
	  }
	}
}
?>


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
	<form class="form w-25 m-auto mt-5" method="POST" action="" enctype="multipart/form-data">
		<input class="form-control" type="file" name="file">
		<input class="form-control mt-3 btn btn-primary" type="submit" name="upload">
	</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>