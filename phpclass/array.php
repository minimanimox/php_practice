<?php 
    $names = ["Mina", "Victor", "John", "Robinson", "Jun", "Jisun"];
    $names2 = ["Adrian", "Joao", "Diego"];

    echo(print_r($names))."</br>";
    array_splice($names,2,1); //it changes index numbers /will remove or replace an item/s within an array and will change the index number
    //index number 2 and one letter
    print_r($names);

    echo "</br>";
    array_splice($names,2,1,["adrian","Joao","Diego"]);
    print_r($names); 

    echo "</br>";
    unset($names[1]); //will remove/unset a value/s but does not change the index number
    print_r($names);

    echo "</br>";
    unset($names[1], $names[3], $names[4]); //will remove/unset a value/s but does not change the index number
    print_r($names);

    echo "</br>";
    $student1 = ["fname"=>"Mina","lname"=>"Jisun","friendName"=>"Victor"];
    //array_splice($student1,1,1); //offset is position so you can use it for associate array
    //yu can also use this method for an associate array. Note: Offset is not Index number, rather it's a starting position in form of an integer number
    print_r($student1);

    echo "</br>";
    //unset($student1["fname"]);  //can't use index
    print_r($student1);

    echo "</br>";
    print_r(array_diff($names, $names2)); //difference from first one

    echo "</br>";
    print_r(array_diff($student1, ["Mina","Jisun"])); 
    //compare first array with the second one based on the values and return the differences within the first array. Note: in associate array use values for comparison

    echo "</br>";
    print_r(array_pop($student1)); //remove last one and pop it
    echo "</br>";
    print_r(array_shift($student1)); //remove first one and pop it
    echo "</br>";
    print_r($student1);

    echo "</br>";
    //array_push($student1,["GPA"=>70.56,"program"=>"Web Dev"]); //use index array not associate array
    $names2 = ["Adrian", "Joao", "Diego"];
    array_push($names2,"Matt","Ryoko"); //add item/s to the end of an index based array
    print_r($names2);

    echo "</br>";
    $student1 += ["GPA"=>76.7,"program"=>"Web Dev"]; //a mothod to add key, value pairs to the end of an associate
    print_r($student1);

    echo "</br>";
    sort($names2);  //ascending
    print_r($names2);
    rsort($names2);  //descending order
    print_r($names2);

    echo "</br>";
    ksort($student1);
    print_r($student1); //numbers first
    echo "</br>";
    krsort($student1); //descending order based on keys. ascending is ksort
    print_r($student1);

    asort($student1);
    print_r($student1);
    arsort($student1); //sorts an associate array in descending order based on value. For ascending sort use asort
    print_r($student1);
    ?>