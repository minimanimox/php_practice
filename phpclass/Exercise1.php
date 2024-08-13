<?php 
    // GET 요청으로 전달된 "mainstr"과 "key"가 존재하는지 확인합니다.
    if (isset($_GET["mainstr"]) && isset($_GET["key"])) { 
        $limit = 0;  // 검색을 시작할 위치를 나타내는 변수
        $foundKeys = [];  // 키워드가 발견된 위치를 저장할 배열

        // "mainstr"에서 "key"를 반복적으로 찾습니다.
        // strpos() 함수는 키워드가 발견된 위치를 반환하며, 발견되지 않으면 false를 반환합니다.
        while ($foundOffset = strpos($_GET["mainstr"], $_GET["key"], $limit)) {  
           $limit = $foundOffset + strlen($_GET["key"]);  // 다음 검색 시작 위치를 업데이트
           array_push($foundKeys, $foundOffset);  // 발견된 위치를 배열에 추가
        }
        
        // 결과 배열을 출력합니다.
        print_r($foundKeys);
    } else {
        // "mainstr" 또는 "key"가 전달되지 않았을 경우, 406 Not Acceptable HTTP 응답 코드를 반환하고 메시지를 출력합니다.
        http_response_code(406);
        echo "Wrong keys bud!!!!";
    }
?>
