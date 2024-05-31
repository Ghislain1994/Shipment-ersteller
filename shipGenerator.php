<?php
$xmlObj = new DOMDocument();
$counter = 0;
$dataname = '';
$count_TMS = 0;
//This function to know the file number  
function filenameCounter($xmlfile){
	$value = 0;
	$value = -(int) filter_var($xmlfile, FILTER_SANITIZE_NUMBER_INT);
	return ($value == 0) ? 1 : $value;
	
}
//global function count
/** Mit diese Funktion wird die letzte nummer aus xml-File extrahiert und für die Inkremmetierung verwendet */
function counter($xmlfile){
	$lastnr = count($xmlfile);
	$result = array($lastnr);
	$result = getXMLvalue($xmlfile);
	$value ='';
	if ($lastnr > 0) {
        for ($i = $lastnr; $i <= $lastnr; $i++) {
            if (array_key_exists($i-1, $result)) {
                $value = $result[$i-1];
            } else {
                $value = $result[$i-1];
            }
            #$GLOBALS['counter'] = -(int) filter_var($value, FILTER_SANITIZE_NUMBER_INT); 
			preg_match('/\d+/', $value, $matches);
            if (!empty($matches)) {
                $number = $matches[0];
                $GLOBALS['counter'] = (int) $number;
            } else {
                echo 'No number found in value.', "</br>";
            }
        }
    }
	if($GLOBALS['counter'] == 0){
		return 1;
	}else{
		return $GLOBALS['counter'];
	} 
}
//This function help to move all number on String Variable
/** Aus unterschiedliche Service-Type werden aus der XMl-File-Name Nummer extrahiert */
function number_Entf($xmlfile) {
    $lastnr = count($xmlfile);
    $result = getXMLvalue($xmlfile);
    $varValue = array();

    foreach ($result as $value) {
        if (str_contains($value, 'SA') || str_contains($value, 'SE') || str_contains($value, 'NV')) {
            $varValue[] = substr($value, 0, 5);
        } else if(str_contains($value, 'GROUPAGE')){
			$varValue[] = substr($value, 0, 12);
		} else if(str_contains($value, 'DIRECT')){
			$varValue[] = substr($value, 0, 9);
		}   
		else {
            $varValue[] = substr($value, 0, 4);
        }
    }

    // Entferne alle Zahlen aus den Strings
    $varValue = array_map(function ($string) {
        return preg_replace('/\d+/', '', $string);
    }, $varValue);

    return $varValue;
}
//this function open xml file
function openXMLfile($xmlfile) {
  if(file_exists($xmlfile) != false){
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
		#echo "GetCounter TMSID: ".$result[$i]. "</br>";
	}
	return $result;
	
}
/** Mit dieser Funktion wird die abgeholte Nummer hochgezählt */
function getCounter($xmlElement){
	$stopCount= count($xmlElement);
	$element = array($stopCount);
	$element = getXMLvalue($xmlElement);
	$element = number_Entf($xmlElement);
	$result = array($stopCount);
	$value = '';
	for($i = 1; $i<=$stopCount; $i++){
		$result[$i] =$element[$i-1] . ++$GLOBALS['counter'];	
	}
	return $result;
}
function setFilename($xmlfile){
	$value = '';
	if(str_contains($xmlfile, 'SA')){
		$value = 'SA';
		return $value;
	}else if(str_contains($xmlfile, 'SE')){
		$value = 'SE';
		return $value;
	}else if(str_contains($xmlfile, 'Groupage')){
		$value = 'Groupage';
		return $value;
	}else if(str_contains($xmlfile, 'DIRECT')){
		$value = 'DIRECT';
		return $value;
	}
	else if(str_contains($xmlfile, 'NV')){
		$value = 'NV';
		return $value;
	}

}
/** Hier werden aus ausgewähltem Datei die Global Counter nummer aus TMS-ID oder References ID extrahiert */
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
  if((!empty($reference) && $reference > 1)){
	$GLOBALS['counter'] = counter($reference);
  }else{
	$GLOBALS['counter'] = counter($tmsid);
  }
  
  $GLOBALS['dataname'] =$_FILES['doc']['name'];
  #$GLOBALS['count_TMS'] = counter($tmsid);
  #echo getTMSIDCounter($tmsid);

  #echo "Tmsid counter: ". $GLOBALS['count_TMS'];
	
}
function generateTimestamp() {
    return date("d.m.Y H:i:s");
}
/** Hier werden die neue Werte hinzugefügt */
if(isset($_FILES['templ']) && ($_FILES['templ']['error'] == UPLOAD_ERR_OK)){
    $templ = openXMLfile($_FILES['templ']['tmp_name']);
    $shipments = $templ->xpath('Shipments/Shipment');
    $tmsid = $templ->xpath('Shipments/Shipment/TMS-ID');
    $references = $templ->xpath('Shipments/Shipment/References/Reference');
	$refTyp = $templ->xpath('Shipments/Shipment/References/Reference/Ref-Type');
	$reference = $templ->xpath('Shipments/Shipment/References/Reference/Reference');
    $eta = $templ->xpath('Shipments/Shipment/ETA');
	$actuETA = $_POST['eta'];
	$newDateETA = date("d.m.Y H:i:s", strtotime($actuETA));

    echo 'neue ETA: ', $newDateETA , "</br>";

	if (!empty($tmsid)) {
        $array1 = getCounter($tmsid);
    } else {
        // Handle case where TMS-ID is not found
        echo "TMS-ID not found in the XML.";
        exit;
    }
    
    if (!empty($references) && $references > 1) {
        $array = getCounter($references);
    }
    
	foreach ($shipments as $shipment) {
        $shipment->{'TMS-ID'} = $array1[1]; 
        $dataname = $array1[1]; 
        $shipment->{'Consignment-Note'} = $array1[1]; 
    }

    foreach ($shipments as $shipment) {
        $references = $shipment->xpath('References/Reference');
        if (!empty($references) && $references > 1) {
            foreach ($references as $index => $reference) {
                if (isset($reference->{'Reference'}) && !empty($reference->{'Reference'})) {
                    $reference->{'Reference'} = $reference->{'Reference'} . $array[$index + 1];
                } else {
                    // Fallback to TMS-ID if Reference/Reference is not present
                    $reference->{'Reference'} = $array1[$index + 1];
                }
            }
        }
	}
   
    $timeStamp = $templ->Shipments[0]->Shipment->{'TMS-Timestamp'} = generateTimestamp();
    $date = $templ->Shipments[0]->Shipment->{'Date'} = date("d.m.Y");
    $eta = $templ->Shipments[0]->Shipment->{'ETA'} = $newDateETA;
	$filename = $dataname . ".xml";
    $templ->asXML($filename);
    echo "<a href=".$filename.">". $filename. "</a> wurde erfolgreich generiert";
}

?>

 
		