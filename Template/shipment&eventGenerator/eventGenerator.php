<?php
    if(isset($_POST['generate']))
    {
        #header("Content-Type:text/xml");
        $shipID = $_POST['shipid'];
        $eventCode = (string)$_POST['codeBtn'];
        $evDes = $_POST['eventDescriptionBtn'];
        $evDate = $_POST['eventDateBtn'];
        $mynve = (string)$_POST['nveBtn'];
        $com = (string)$_POST['comBtn'];

        
        $xml = new DOMDocument('1.0', 'utf-8');
        $xml ->formatOutput = true;
        $ycon = $xml->createElement("YCON");
        $statusdate = $xml->createElement("Statusdaten");
        $status = $xml->createElement("Status");
        $tmsstatus = $xml->createElement("TMS-Status", "UPD");
        $tmstime = $xml->createElement("TMS-Timestamp",  $evDate);
        $tmssource =$xml->createElement("TMS-Source", "YCON-XML-M3-FB_STATUS");
        $tmsid = $xml->createElement("TMS-ID", $shipID);
        $tmsstatusid =$xml->createElement("TMS-Status-ID", "1735966");
        $event = $xml->createElement("Event");
        $code = $xml->createElement("Code", $eventCode);
        $description = $xml->createElement("Description", $evDes);
        $mpCode =$xml->createElement("MPCode");
        $mpDescritpion =$xml->createElement("MPDescription");
        $signature = $xml->createElement("Signature");
        $note1 =$xml->createElement("Note1", $com);
        $note2 = $xml->createElement("Note2");
        $note3 = $xml->createElement("Note3");
        $nve = $xml->createElement("NVE", $mynve);
        $eventTime = $xml->createElement("Timestamp", $evDate);
        $submission = $xml->createElement("Submission", $evDate);


        $xml ->appendChild($ycon);
        $ycon->appendChild($statusdate);
        $ycon->appendChild($status);
        $statusdate->appendChild($status);
        $status->appendChild($tmsstatus);
        $status->appendChild($tmstime);
        $status->appendChild($tmssource);
        $status->appendChild($tmsid);
        $status->appendChild($tmsstatusid);
        $status->appendChild($event);
        $event->appendChild($code);
        $event->appendChild($description);
        $event->appendChild($mpCode);
        $event->appendChild($mpDescritpion);
        $event->appendChild($signature);
        $event->appendChild($note1);
        $event->appendChild($note2);
        $event->appendChild($note3);
        $event->appendChild($nve);
        $event->appendChild($eventTime);
        $event->appendChild($submission);

        if($mynve == ""){
            $filename = "event-". $shipID. "-". $eventCode.".xml";   
        }else{
            $filename = "event-". $shipID. "-". $eventCode."-".$mynve.".xml";
        }
        $xml->save($filename);
        echo "<a href=".$filename.">". $filename. "</a> has succeffuly generated";

        #echo "Ein Event wurde erstellt";
    }
?>