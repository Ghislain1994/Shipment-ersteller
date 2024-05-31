<?php
$xmlObj = new DOMDocument();
$counter = 0;
$dataname = '';
$count_TMS = 0;
//This function to know the file number  
function filenameCounter($xmlfile){
	$value = 0;
	$value = -(int) filter_var($xmlfile, FILTER_SANITIZE_NUMBER_INT);
	if($value ==0){
		return 1;
	}else{
		return $value;
	}
	
}
//global function count
function counter($xmlfile){
	$lastnr = count($xmlfile);
	$result = array($lastnr);
	$result = getXMLvalue($xmlfile);
	$value ='';
	for($i = $lastnr; $i<=$lastnr; $i++){
		$value = $result[$i-1];
		$GLOBALS['counter'] = -(int) filter_var($value, FILTER_SANITIZE_NUMBER_INT); 
	}
	if($GLOBALS['counter'] == 0){
		return 1;
	}else{
		return $GLOBALS['counter'];
	} 
}
//This function help to move all number on String Variable
function number_Entf($xmlfile){
	$lastnr = count($xmlfile);
	$result = array($lastnr);
	$result = getXMLvalue($xmlfile);
	$value ='';
	$varValue = array($lastnr);
	for($i = 0; $i< $lastnr; $i++){
		if(str_contains($result[$i], 'FTL')||str_contains($result[$i], 'GRP')||str_contains($result[$i], 'LTL'))
		 {
			$value = substr($result[$i], 0, 6);
		 }else{
			$value = substr($result[$i], 0, 4);
		 }
		$varValue[$i] = filter_var($value, FILTER_SANITIZE_STRING);
	}
	return $varValue;
}
//this function open xml file
function openXMLfile($xmlfile) {
  if(@file_exists($xmlfile) != false){
	$GLOBALS['xmlObj'] = simplexml_load_file($xmlfile);
	return $GLOBALS['xmlObj'];
  }else{
	  exit('Failed to open xml File');
  }
  
}
//This function get the Value of xml ELement
function getXMLvalue($xmlpath) { 
	$value = array(count($xmlpath));
	$i=0;
   foreach($xmlpath as $GLOBALS['xmlObj']){
	$value[$i] = $GLOBALS['xmlObj']; 
	$i++; 
   }
	return ($value) ? $value : false;   
}
//This function change the value of xml Element
function changeXMLvalue($xmlpath,$xmlvalue='') {
	$node = '';
	foreach($xmlpath as $GLOBALS['xmlObj']){
		$node = $GLOBALS['xmlObj']->getName();
	}
	return $GLOBALS['xmlObj']->{$node} = htmlspecialchars($xmlvalue);
}
function getTMSIDCounter($xmlElement){
	$stopCount= count($xmlElement);
	$element = array($stopCount);
	$element = getXMLvalue($xmlElement);
	$element = number_Entf($xmlElement);
	$result = array($stopCount);
	$value = '';
	for($i = 1; $i<=$stopCount; $i++){
		$result[$i] =$element[$i] . ++$GLOBALS['count_TMS'];	
		echo "GetCounter TMSID: ".$result[$i]. "</br>";
	}
	return $result;
	
}
function getCounter($xmlElement){
	$stopCount= count($xmlElement);
	$element = array($stopCount);
	$element = getXMLvalue($xmlElement);
	$element = number_Entf($xmlElement);
	$result = array($stopCount);
	$value = '';
	for($i = 1; $i<=$stopCount; $i++){
		$result[$i] =$element[$i-1] . ++$GLOBALS['counter'];	
		#echo "GetCounter Result ".$result[$i]. "</br>";
	}
	return $result;
}
function setFilename($xmlfile){
	$value = '';
	if(str_contains($xmlfile, 'FTL')){
		$value = 'FTL';
		return $value;
	}else if(str_contains($xmlfile, 'LTL')){
		$value = 'LTL';
		return $value;
	}else if(str_contains($xmlfile, 'GRP')){
		$value = 'GRP';
		return $value;
	}

}
if (isset($_FILES['doc']) && ($_FILES['doc']['error'] == UPLOAD_ERR_OK)) {

  //Hier wird File gelesen und dann value auf File ausgenutzt
  $xml = openXMLfile($_FILES['doc']['tmp_name']);
  $ship = $xml->xpath('Shipments/Shipment');
  $tmsid = $xml->xpath('Shipments/Shipment/TMS-ID');
  $eta = $xml->xpath('Shipments/Shipment/ETA');
  $refTyp = $xml->xpath('Shipments/Shipment/References/Reference/Ref-Type');
  $reference = $xml->xpath('Shipments/Shipment/References/Reference/Reference');
  $tmsid_1 = $xml->Shipments[0]->Shipment;
  $eta_1 = $xml->Shipments[0]->Shipment ;
  $GLOBALS['counter'] = counter($reference);
  $GLOBALS['dataname'] =$_FILES['doc']['name'];
  #$GLOBALS['count_TMS'] = counter($tmsid);
  #echo getTMSIDCounter($tmsid);

  #echo "Tmsid counter: ". $GLOBALS['count_TMS'];
	
}
if(isset($_FILES['templ']) && ($_FILES['templ']['error'] == UPLOAD_ERR_OK)){
	$templ = openXMLfile($_FILES['templ']['tmp_name']);
	$ship = $templ->xpath('Shipments/Shipment');
	$tmsid = $templ->xpath('Shipments/Shipment/TMS-ID');
	$eta = $templ->xpath('Shipments/Shipment/ETA');
	$refTyp = $templ->xpath('Shipments/Shipment/References/Reference/Ref-Type');
	$reference = $templ->xpath('Shipments/Shipment/References/Reference/Reference');
	$tmsid_1 = $templ->Shipments[0]->Shipment;
	$eta_1 = $templ->Shipments[0]->Shipment;
	$actuETA = $_POST['eta'];
	$value = '';
	$array1= getCounter($tmsid);
	$array= getCounter($reference);
for($i=1; $i<=count($tmsid);$i++ ){
	#echo "TMS-ID: ".$array1[$i] . "</br>";
	$tmsid_1->{'TMS-ID'} = $array1[$i];
}

for($i=1; $i<=count($reference);$i++ ){
	#echo "array: ".$array[$i] . "</br>";
$templ->Shipments[0]->Shipment->References[0]->Reference[$i-1]->{'Reference'} = $array[$i];
}


$count = filenameCounter($GLOBALS['dataname']);
$dataname = $_FILES['templ']['name'];
$filename = setFilename($dataname). "-" . (++$count).".xml";
$eta_1 ->{'ETA'} = $actuETA;
$templ ->asXML($filename);
echo "<a href=".$filename.">". $filename. "</a> has succeffuly generated";
}
/*if(isset($_POST['generate'])){
	echo "Die Xml File werden generiert....";
}*/

?>

 
		