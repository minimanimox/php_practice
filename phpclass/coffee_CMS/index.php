<?php 
    require("./Classes/UserClass.php");
    $c1 = new Customer(10, "Jisun", "Victor", "jv@mail.com", "Vancouver", 50);

    echo json_encode($c1->display_info());

    $s1 = new Staff(1, "Mina", "Lee", "mnl@mail.com", "Vancouver", "20231011", "working");

    echo json_encode($s1->display_info()); //배열 순서는 달라질 수 있음
?>