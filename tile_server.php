<?php
	
	$tilepack = $_GET["tp"];
	$fol = dirname(__FILE__);
    $tp_path = $fol."/pixshelded/pixshelded_match/".$tilepack;
    $tilepack_path = $fol."/pixshelded/pixshelded/".substr($tilepack, 0,strpos($tilepack, "."));
    
    $dims = getimagesize($tp_path);
    $width = $dims[0];
    $height = $dims[1];

    $elems = array_diff(scandir($tilepack_path),array('.', '..'));


    for($i=2;$i<=count($elems)+1;$i++){
        for($j=$i+1;$j<=count($elems)+1;$j++){
            $ai = str_replace(".png", "", substr($elems[$i], strripos($elems[$i], "_")+1,strlen($elems[$i]) )); 
            $aj = str_replace(".png", "", substr($elems[$j], strripos($elems[$j], "_")+1,strlen($elems[$j]) ));
            if( ((int)$ai) > ( (int)$aj) ){
                $a = $elems[$i];
                $elems[$i] = $elems[$j];
                $elems[$j] = $a;
            }
        }
    }

    $sample = $elems[2];
    $px = (int) (substr($elems[2], 0, strpos($elems[2], "x") ));
    $rowlen = $width/$px;



    $elem_state = array();
    $i = 0;
    $row = array();
    foreach ($elems as $key => $value) {
    	if($i%$rowlen==0 && $i!=0){
    		array_push($elem_state, $row);
    		$row = array();
    	}
    	array_push($row,$value);
    	$i += 1;
    }
    array_push($elem_state, $row);
    echo json_encode($elem_state);
?>