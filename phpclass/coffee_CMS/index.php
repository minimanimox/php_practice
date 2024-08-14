<?php 
    try{
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            require("./Classes/UserClass.php");
            //echo "UserClass loaded successfully."."</br>";
            require("./Classes/FileClasses.php");
            //echo "FileClasses loaded successfully."."</br>";
            if(isset($_FILES["json_file"])) {
                $fileObj = new File("./data");
                if($fileObj->create_dir("userData", true)) {
                    if($fileObj->upload_file($_FILES["json_file"], "userData")) {
                        echo $_FILES["json_file"]["name"]." uploaded";
                    } else {
                        throw new Exception($_FILES["json_file"]["name"]." not uploaded");
                    }
                }
            }
        } else {
            throw new Exception("Request method is not valid", 406);
        }

        
        $fileObj = new File("./data");
        if ($fileObj->upload_file($_FILES["upload"])) {
            echo $_FILES["upload"]["name"]."uploaded";
        }


        // if ($fileObj->upload_file($_FILES["jsonFile"])) {
        //     $fileObj->add_usertype_in_json($_FILES['jsonFile']);
        //     echo $_FILES["jsonFile"]["name"]."uploaded";
        // }

        //$fileObj->set_new_addr("test2");
        //$fileObj->create_dir("test_dir");
        //$fileObj->remove_dir("test_dir");
        //echo "File object created successfully."."</br>";
        //$fileObj->write_file("test.txt", "I don't know");
        //$fileObj->remove_file("test.txt");

        //echo "File written successfully."."</br>";
        //echo $fileObj->read_file("test.txt");
        //print_r($fileObj->read_dir());

        //print_r($_FILES["0_img"]["name"]); 
        //echo pathinfo($_FILES["0_img"]["name"], PATHINFO_EXTENSION);
        //print_r(getimagesize($_FILES["0_img"]["tmp_name"])); //to validate if it's real img
    } catch(Exception $err) {
        http_response_code($err->getCode());
        echo ($err->getMessage());
        echo "\n" . $err->getTraceAsString(); // 추가된 디버깅 정보
    } finally { 
        // finally 블록은 선택 사항입니다.
    }
    
?>