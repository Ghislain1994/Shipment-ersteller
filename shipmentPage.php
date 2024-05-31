<!DOCTYPE>
<html lang="en">
<head>
<title> Shipment Generator </title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<?php include('language.php') ?>	
<?php
// define variables and set to empty values
$docErr = $etaErr = $templErr  = "";
$doc = $eta  = $templ = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["doc"])) {
    $docErr = "Last Shipment is required";
  } else {
    $doc = test_input($_POST["doc"]);
  }
  
  if (empty($_POST["eta"])) {
    $etaErr = "ETA is required";
  } else {
    $eta = test_input($_POST["eta"]);
  }
  if (empty($_POST["templ"])) {
    $templErr = "Template is required";
  } else {
    $templ = test_input($_POST["templ"]);
  }
 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="infoGeneration">
    <p> You may have to choice firstly the last generate shipment, eta and the template for which shipment you may have to generate!</p>
</div>   
<div class="row version"> 
	<div class="col-md-9"></div>  
	<div class="col-md-2 align right">
	<ul class="nav" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
  <li class="nav-item" role="presentation">
    <a href ="?lang=de" class="nav-link active rounded-5" id="home-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">DE</button></a> 
  </li>	
  <li class="nav-item" role="presentation">
    <a href ="?lang=en"  class="nav-link rounded-5" id="home-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">EN</button></a>
  </li>	
</ul>
</div>
</div>
	<form method = "POST" action  = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	<?php include('shipGenerator.php') ?>
	<h3> <?=$language["buttonShipment"] ?> </h3>
	<div class="inputCss">
	<input id = "datei" type="file" name="doc" accept=".xml" > 
	<label><?=$language["firstInput"] ?></label>
	<span class="error">* <?php if($docErr) {echo $docErr;}?></span>
	</div>
	<div class="inputCss">
	<input type = "datetime-local" name = "eta" size="50"> 
	<label>ETA</label>
	<span class="error">* <?php if($etaErr){echo $etaErr;}?></span>
	</div>
	<div class="inputCss">
	<input id = "datei" type="file" name="templ" accept=".xml">
	<label><?=$language["selectTemplate"] ?></label>
	<span class="error">* <?php if($templErr){echo $templErr;}?></span>
	</div>
	<a href = "/homepage.php"> <input id ="generateButton" type ="button" name="backBtn" value= "<?=$language["backButton"] ?>"></a>
	<input id ="generateButton" type="Submit" name ="generate" value = "<?=$language["generateButton"] ?>">
	<a href = "shipmentPage.php"> <input id ="generateButton" type ="button" name="refreshBtn" value= "<?=$language["refreshButton"] ?>"></a>
	
	</form>
	
</body>
<?php $currentYear = getdate()["year"]; ?>
<footer>
    <p> ©<?php echo $currentYear; ?> ycon Solutions GmbH</p>
</footer>
</html>