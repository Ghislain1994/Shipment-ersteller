<html>
<head>
<title> Event Generator </title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<?php include('eventGenerator.php') ?>
	<?php include('language.php') ?>
	<div class="infoGeneration">
    <p> Fill the formular form and click to generate an Event</p>
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
	<form method = "POST" action  = "eventPage.php">
	<h3> <?=$language["buttonEvent"] ?></h3> 	
	<div class="inputCss">
	<input type="text" name="shipid">
	<label><?=$language["shipmentIdLabel"] ?></label>
	</div>
	<div class="inputCss">
	<input type="text" name = "codeBtn" >
	<label><?=$language["eventCodeLabel"] ?></label>
	</div>
	<div class="inputCss">
	<input name = "eventDescriptionBtn" type="text">
	<label><?=$language["eventDescription"] ?></label>
	</div>
	<div class="inputCss">
    <input type = "datetime-local" name = "eventDateBtn"> 
	<label><?=$language["eventDateLabel"] ?></label>
	</div>
	<div class="inputCss">
	<input name = "comBtn" type="text">
	<label><?=$language["commentLabel"] ?></label>
	</div>
	<div class="inputCss">
	<input name = "nveBtn" type="text" >
	<label><?=$language["nveLabel"] ?></label>
	</div>
	<a href = "/homepage.php"> <input id ="generateButton" type ="button" name="backBtn" value= "<?=$language["backButton"] ?>"></a>
	<input id ="generateButton" type="Submit" name ="generate" value = "<?=$language["generateButton"] ?>">
	<a href = "shipmentPage.php"> <input id ="generateButton" type ="button" name="refreshBtn" value= "<?=$language["refreshButton"] ?>"></a>
    

	</form>
</body>
<footer>
        <p>© 2023 ycon Solutions GmbH</p>
    </footer>
</html>