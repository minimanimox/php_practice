<?php 
$mainstr = $_GET["mainstr"]; // 예: Mina, Jun, Victor
$delim = $_GET["delim"];
if(isset($mainstr) && isset($delim)) {
    $sentences = []; // 단어들을 저장할 배열 초기화
    $start = 0; // 시작 위치 초기화
    while (($end = strpos($mainstr, $delim, $start)) !== false) { // strpos의 결과가 false가 아닌 동안
        $sentences[] = substr($mainstr, $start, $end - $start); // 단어 추출하여 배열에 추가
        $start = $end + strlen($delim); // 다음 시작 위치 설정
    }
    // 마지막 단어 추가
    $sentences[] = substr($mainstr, $start);
    
    print_r($sentences);
} else {
    http_response_code(406);
    echo "You have no keys";
}
?>
