<!DOCTYPE>
<html lang="en">
<head>
<title> Shipment Generator </title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

	<center>
	<div>
	<form method = "POST" action  = "shipmentPage.php" enctype="multipart/form-data">
	<?php include('shipGenerator.php') ?>
	<h3> Shipment Generate </h3> </br>
	Auswahl von letzten Shipments <input id = "datei" type="file" name="doc" accept=".xml" > </br></br>
	ETA <input type = "datetime-local" name = "eta" size="50"> </br></br>
	Auswahl von Template <input id = "datei" type="file" name="templ" accept=".xml"> </br></br>
	<a href = "homepage.php"> <input type ="button" name="backBtn" value= "Back"></a>
	<input type="Submit" name ="generate" value = "Generate">
	<a href = "shipmentPage.php"> <input type ="button" name="refreshBtn" value= "Refresh"></a>
	</form>
	</div>
	</center>
</body>
</html>