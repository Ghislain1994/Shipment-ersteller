<?php
$lang = "en";
if(isset($_GET["lang"]))
{
    $lang = $_GET["lang"];
}
$language = parse_ini_file("language/$lang.ini");
?>