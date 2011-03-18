<?php
    $max = 3; //limit autocompletion

    //dummy data for now
    $data = Array( "Bilzen", "Hasselt", "Antwerpen", "Luik", "Namen" );


    //Return a XML String
    header('Content-Type: text/xml');
    $returnXML = "<?xml version='1.0'?>";
    $returnXML .= "<train>"; //root, must be defined
    for($i = 0; $i<count($data);$i++){
        //populate $returnXML
        $returnXML .= "<name>" . $data[$i] . "</name>";
    }
    $returnXML .= "</train>";

    print $returnXML;
?>
