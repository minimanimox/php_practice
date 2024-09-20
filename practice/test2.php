<?php
    //배열에 key가 있다면 그 위치를 반환하는 프로그램
    if(isset($_POST["mainstr"]) && isset($_POST["findKey"])) {
        $offset = 0;
        $result = [];

        $foundKey = strpos($_POST["mainstr"],$_POST["findKey"], $offset);
        
    } else {
        http_response_code(406);
        echo "Wrong Keys!";
    }

?>