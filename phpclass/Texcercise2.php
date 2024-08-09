<?php 
    //mainstr = "Mina/Jun/Victor"
    //delim = "/"
    if(isset($_GET["mainstr"]) && ($_GET["delim"])) {
        $offset = 0;
        $outputArray = [];
        while($foundOffset = strpos($_GET["mainstr"],$_GET["delim"],$offset)) {
            $item = substr($_GET["mainstr"],$offset,$foundOffset-$offset);
            array_push($outputArray,$item);
            $offset = $foundOffset + 1;
        }
        
        $item = substr($_GET["mainstr"],$offset);
        array_push($outputArray,$item);
        print_r($outputArray);
    } else {
        http_response_code(406);
        echo "Wrong keys";
    }

?>