<?php 
//mainstr에 key가 존재하는지 확인
    if(isset($_GET["mainstr"]) && isset($_GET["findKey"])) {  //key: mainstr  value: this is test, test is good
        $limit = 0;  //offset                                   key: findKey  value: test
        $resultFoundKeys = []; //찾은 키들의 위치를 넣어주는 배열

        while($foundOffset = strpos($_GET["mainstr"], $_GET["findKey"], $limit)) { //0부터 키를 검색해서 그 위치를 저장
            $limit = $foundOffset + strlen($_GET["findKey"]); //다음 검색을 위한 위치 
            array_push($resultFoundKeys, $foundOffset); // result가 될 array에 위치를 추가한다
        }
        print_r($resultFoundKeys);
    } else {
        http_response_code(406);
        echo "Wrong Keys!";
    }


?>