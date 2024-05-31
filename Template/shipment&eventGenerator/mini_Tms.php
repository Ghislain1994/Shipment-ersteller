<!DOCTYPE>
<html lang="en">
<head>
<title> Mini-TMS Projekt </title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

	<center>
	<div>
	<form method = "POST" action  = "shipGenerator.php" enctype="multipart/form-data">
	<h3> Shipment Generate </h3> </br>
	Auswahl von letzten Shipments <input id = "datei" type="file" name="doc" accept=".xml" > </br></br>
	ETA <input type = "datetime-local" name = "eta" size="50"> </br></br>
	Auswahl von Template <input id = "datei" type="file" name="templ" accept=".xml"> </br></br>
	<a href = "homepage.php"> <input type ="button" class="button_active" name="backBtn" value= "Back"></a>
	<button type="Submit" name ="generate"> Generate </button>
	</form>
	</div>
	</center>
</body>
</html>