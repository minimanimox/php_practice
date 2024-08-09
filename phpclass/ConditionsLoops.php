<?php 
    // if(condition) {
    //     //if condition is TRUE
    // } elseif(condition2) {
    //     //if condition2 is TRUE
    // } else {
    //     //if all conditions are FALSE
    // }

    $keyboardOwner = "Robinson";
    //echo (condition)? if condition is true : if condition is false
    //echo $keyboardOwner == "Robinson" ? "Noisy" : "Not noisy"; //shorthanded if condition /Ternary operator

    //while(condition){
        //set of instructions
    //}

    //at least once it excecutes
    //do {
        //set of instructions
    //} while(condition) {

    //}

    $number = 10;
    $counter = 0;
    while($counter<=$number){  //when you don't know when it's gonna end
        if($counter%2 == 0){
            echo "$counter </br>";
        }
        $counter++;
    }
    for($counter=0; $counter<=$number; $counter++){ //initializing 
        if($counter%2 == 0){
            echo "$counter </br>";
        }
    }
?>