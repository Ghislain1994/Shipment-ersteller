<html>
<head>
<title> Event Generator </title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

	<center>
	<?php include('eventGenerator.php') ?>
	<div>
	<form method = "POST" action  = "eventPage.php">
	<h3> Event Generate </h3> </br>
	Shipment ID <input type="text" name="shipid"> </br></br>
    Event-Code <input  type="text" name = "codeBtn" ></br></br>
	Event-Description <input name = "eventDescriptionBtn" type="text"></br></br>
	Event-Date <input type = "datetime-local" name = "eventDateBtn" size="50"> </br></br>
	Commentar <input name = "comBtn" type="text"></br></br>
	NVE <input name = "nveBtn" type="text"></br></br>
	<a href = "homepage.php"> <input type ="button" name="backBtn" value= "Back"></a>
	<input type="Submit" name ="generate" value= "Generate">
	<a href = "eventPage.php"> <input type ="button" name="refreshBtn" value= "Refresh"></a>
	</form>
	</div>
	</center>
</body>
</html>