<!DOCTYPE>
<html lang="en">
<head>
<title> Mini-TMS Projekt </title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('language.php') ?>
<div class="infoGeneration">
    <p> You may have to choice what you want to generate please...</p>
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
<form>
<h3> <?=$language["info"]?></h3>
<a href="shipmentPage.php"> <input id = "generateButton" type="button" class="button_active" value="<?=$language["buttonShipment"] ?>"></a>
<a href="eventPage.php"> <input id ="generateButton" type="button" class="button_active" value="<?=$language["buttonEvent"] ?>"></a>
</form>
</body>
<footer>
        <p>© 2023 ycon Solutions GmbH</p>
</footer>
</html>