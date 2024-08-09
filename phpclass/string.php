<?php
    $str = "Joao likes Red/Pink Shoes."; //returns the length of a string (characters)
    echo strlen($str)."<br/>";

    echo str_word_count($str)."<br/>"; //단어수 세기
    print_r(str_word_count($str,2)); //echo 사용불가 array때문에 str_word_count($string, 1) 형식으로 호출하면, 문자열을 단어 단위로 배열로 반환합니다.
    //returns the number of words if the second parameter is 0. Or returns an array of words if the second parameter is 1
    echo "<br/>";

    echo strpos($str,"Red"); //returns the positon number of first match
    echo strpos($str,"Green"); //returns nothing cause it's false
    echo strpos($str,"Red",2); //offset 12 default is 0 Third parameter will define the start position for the search, if there is no match it will be nothing

    $names = ["Mina","Jisun",23.5,"Victor"];  //in tray (index based array)
    print_r($names);
    echo "<br/>";
    print_r($names[1]); //can use index 

    $student1 = ["fname"=>"Mina","lname"=>"Jisun","friendName"=>"Victor"];
    print_r($student1);  //for entire array to show

    print_r($student1["lname"]); //use keyname for value, cannot use index this time because of key

    print_r($_GET);
    
    print_r($_GET["mainstr"]); //key 사용할때 []안에 ""넣을것 

?>