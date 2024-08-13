<?php 
    $names = ["Mina", "Victor", "John", "Robinson", "Jun", "Jisun"];
    $names2 = ["Adrian", "Joao", "Diego"];

    echo(print_r($names))."</br>"; 

    print_r(array_diff($names, $names2)); //두번째엔 없고 첫번째에만 있는 요소들 반환

    array_splice($names, 2, 1); //변경하고자하는 배열, $offset 인덱스나 키 등 특정위치, 제거 갯수 
    print_r($names);



    unset($names[1]); //인덱스 변경하지 않고 삭제


    //associate array
    $student1 = ["fname"=>"Mina","lname"=>"Jisun","friendName"=>"Victor"];

    echo "</br>";
    print_r(array_diff($names, $names2)); //difference from first one
?>