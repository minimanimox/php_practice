<?php 
    $fruits = array(
        "Apple"=>1000, 
        "Banana"=>500, 
        "Orange"=>1500 );

    $fruitName = "Apple";

    if (isset($fruits[$fruitName])) {
        echo $fruitName."의 가격은 ".$fruits[$fruitName]."원입니다.";
    } else {
        echo "해당 과일은 목록에 없습니다.";
    }
?>