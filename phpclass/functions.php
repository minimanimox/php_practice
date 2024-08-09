<?php 
    //DRY don't repeat yourself

    // echo displayFullName("Mina", 12); //possible to call it before definition / 12 is possible to be in but it's gonna be string
    
    // function displayFullName(string $fname, string $lname): string{ //parameters, arguments of this function //it will return string
    //     echo var_dump($lname);
    //     //echo "Your fullname is: $fname $lname"; //it's not returning
    //     return "Your fullname is: $fname $lname"; //it's not showing, so use echo to show it
    // }

    $testArray = [45,67,9,10,0];
    //echo isset($testArray[5])?"yes":"No";

    function collection_len(mixed $srcArray): int{ //==count() array $srcArray를 mixed로 바꾸면 argument로 "Hello" 넣어도 됨
        $counter = 0;
        while(isset($srcArray[$counter])){
            $counter++;
        }
        return $counter;
    }
    //쌤이만든거
    function str_reverse(string $srcStr): string {
        $outputStr = "";
        for($idx=collection_len($srcStr)-1;$idx>=0;$idx--){
            $outputStr .= $srcStr[$idx];
        }
        return $outputStr;
    }
    echo str_reverse("Joao");

    //채찍피티
    $testSentence = "Hello";
    
    // 문자열을 거꾸로 만드는 함수
    function reverse_string(string $srcString) {
        $reversedString = '';
        $length = strlen($srcString);
    
        // 문자열의 끝에서부터 시작하여 한 문자씩 추가합니다.
        for ($i = $length - 1; $i >= 0; $i--) {
            $reversedString .= $srcString[$i];
        }
    
        return $reversedString;
    }
    
    echo reverse_string($testSentence); // 출력: "olleH"
    
    function rcollection(string|array $srcCollection):string|array{
        $output = gettype($srcCollection)[0]=='s'?"":[];
        for($idx=collection_len($srcCollection)-1;$idx>=0;$idx--){
            if(gettype($srcCollection)[0]=='s'){
                $output .= $srcCollection[$idx];
            } else {
                $output[collection_len($output)] = $srcCollection[$idx];
            }
        }
        return $output;
    }
    print_r(rcollection($testArray));
    
?>