<?php
    try{
        if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_SERVER["PATH_INFO"])){
            require("./Config.php");
            switch($_SERVER["PATH_INFO"]){
                case "/reg":
                    if($inputArray = validate_keys($_POST,["fname","lname","email","phone","role","pass"])){
                        switch($inputArray["role"]){
                            case "c":
                                $user = new Customer($inputArray["fname"],$inputArray["lname"],$inputArray["email"],$inputArray["phone"]);
                                break;
                            case "s":
                                $user = new Staff($inputArray["fname"],$inputArray["lname"],$inputArray["email"],$inputArray["phone"],$_POST["jobid"],$_POST["hiredate"]);
                        }
                        $user->Register($inputArray["pass"]);
                    }else{
                        throw new Exception("Required key/s are missing.",406);
                    }
                break;
                default:
                    throw new Exception("Request path is not valid.",406);
            }
        }else{
            throw new Exception("Request method is not valid or no path has been provided.",406);
        }
    }catch(Exception $err){
        http_response_code($err->getCode());
        echo ($err->getMessage());
    }finally{

    }
?> 