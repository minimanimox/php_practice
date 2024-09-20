<?php
    function sanitize(mixed $input):mixed{
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    function validate_keys(array $postVar, array $req_keys):array|bool{
        $outputArray = [];
        foreach($req_keys as $key){
            if(array_key_exists($key,$postVar)){
                $outputArray += [$key=>sanitize($postVar[$key])];
                continue;
            }
            else
                return false;
        }
        return $outputArray;
    }
    function Adit_Gen(mixed $server_req, bool $result, string $desc, string $origin_user="") {
        $fname = date("Y-m-d");
        $file = fopen("./data/Logs/$fname.txt","a");   //index에서 진행되기 때문에 ..으로 하면 안되고 .으로 해야됨
        $content = date("Y-m-d H:i:s - ").$server_req["REMOTE_ADDR"].":".$server_req["REMOTE_PORT"];
        $content .= ($origin_user != "")?" origin_user ":" ";
        $content .= ($result)?"Success":"Failed";
        $content .= "desc\n";
        fwrite($file, $content);
        fclose($file);
    }
?>