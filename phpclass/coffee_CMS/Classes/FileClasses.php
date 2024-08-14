<?php 
//$file = fopen("address of the file", "w|r|a+") to open a file using the specified flag
//a: append 

//$data = fread($file, filesize("file address")) reading entire file 

//fwrite($file,  $dataToWrite) to write data into a file opened with either w or a flag

//fclose($file) to close the file handler

//file_exists("address of the file/directory")

//is_dir("address to the directory") check if the address given is a directory and it does exist

//mkdir("address for the new directory") to create a directory, will return error if the given directory exists
    
//rmdir("address to remove a directory") will remove a dirctory

//unlink("address to the file") will remove a file

//scandir("address of the directory") will read the contents of a directory including the . and .. pointers

//3 errors :syntax error (eg. missing ;), logical error, runtime error (there's no such a variable name)

    class File {
        private $srcAddr;
        
        function __construct(string $srcAddr) 
        {
            $this->check_file($srcAddr);
            $this->srcAddr = $srcAddr."/";
        }

        private function check_file($addr, $notFlag=true) {
            if(($notFlag)?!file_exists($addr):file_exists($addr)) {
                throw new Exception(($notFlag)?"Resource not found":"Resource already exists", 404);
            }
        }

        // private function check_file($addr, $notFlag=true) {
        //     if ($notFlag) {
        //         // $notFlag가 true일 때, 파일이 존재하지 않으면 예외를 던짐
        //         if (!file_exists($addr)) {
        //             throw new Exception("Resource not found", 404);
        //         }
        //     } else {
        //         // $notFlag가 false일 때, 파일이 존재하면 예외를 던짐
        //         if (file_exists($addr)) {
        //             throw new Exception("Resource already exists", 404);
        //         }
        //     }
        // }


        function read_file(string $fileName):string {
            $dstFile = $this->srcAddr.$fileName;
            $this->check_file($dstFile);
            $file = fopen($dstFile, "r");
            $data = fread($file, filesize($dstFile));
            fclose($file);
            return $data;
        }

        function write_file(string $fileName, string $data):void {
            $dstFile = $this->srcAddr.$fileName;
            $file = fopen($dstFile, "w");
            
            fwrite($file, $data);
            fclose($file);
        }

        function set_new_addr(string $newAddr) {
            if(is_dir($newAddr)) {
                $this->srcAddr = $newAddr."/";
            } else {
                throw new Exception("Resource not found", 404);
            }
        }

        function create_dir(string $dirName): bool {
            $dstAddr = $this->srcAddr.$dirName;
            $this->check_file($dstAddr, false);
            return mkdir($dstAddr);
        }

        function remove_dir(string $dirName): bool {
            $dstAddr = $this->srcAddr.$dirName;
            $this->check_file($dstAddr);
            return rmdir($dstAddr);
        }

        function remove_file(string $fileName): bool {
            $dstAddr = $this->srcAddr.$fileName;
            $this->check_file($dstAddr);
            return unlink($dstAddr);
        }

        function read_dir(string $dirName = null) {
            $dstAddr = ($dirName=="")?$this->srcAddr:$this->srcAddr.$dirName;
            $this->check_file($dstAddr);
            return array_diff(scandir($dstAddr),[".",".."]);
        }

        function upload_file(array $file,string $dstAddr=""){
            $targetDir = ($dstAddr=="")?$this->srcAddr:$this->srcAddr.$dstAddr."/";
            $fileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            if(array_search($fileType,["jpg","jpeg","bmp","gif","png"])!==false){
                if(!getimagesize($file['tmp_name'])){
                    throw new Exception("Extension is image but content is not.",406);
                }
            }elseif(array_search($fileType,["pdf","doc","docx","json"])===false){
                throw new Exception("Not a valid file type.",406);
            }
            return move_uploaded_file($file['tmp_name'],$targetDir.$file['name']);
        }

        // function upload_file(array $file, string $dstAddr=""){
        //     $targetDir = ($dstAddr=="")?$this->srcAddr:$this->srcAddr.$dstAddr."/";
        //     $fileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

        //     // if ($fileType === "json") {
        //     //     return move_uploaded_file($file['tmp_name'], $targetDir . $file['name']);
        //     // }

        //     if (array_search($fileType,["jpg","jpeg","bmp","gif"])!==false){
        //         if (!getimagesize($file['tmp_name'])){
        //             throw new Exception("Extension is image but content is not.",406);
        //         }
        //     } elseif (array_search($fileType,["pdf","doc","docx"])===false){
        //         throw new Exception("Not a valid file type.",406);
        //     }

        //     return move_uploaded_file($file['tmp_name'],$targetDir.$file['name']);
        // }

        // // function add_usertype_in_json(array $file) {
        // //     $filePath = "./data/".$file['name'];
        // //     $jsonContent = file_get_contents($filePath);
        // //     $jsonData = json_decode($jsonContent, true);

        // //     if ($jsonData === null) {
        // //         throw new Exception("No contents in JSON file.", 400);
        // //     }

        // //     $fileName = strtolower($file['name']);

        // //     // 각 배열 요소에 userType 추가
        // //     // foreach ($jsonData as &$item) {
        // //     //     if (is_array($item)) {
        // //     //         if (strpos($fileName, 'staff') !== false) {
        // //     //             $user = new User($jsonData['uid'], $jsonData['fname'], $jsonData['role'], $jsonData['email'], $jsonData['phone']);

        // //     //             $item['userType'] = 'staff';
        // //     //         } elseif (strpos($fileName, 'customer') !== false) {
        // //     //             $user = new User($jsonData['uid'], $jsonData['fname'], $jsonData['role'], $jsonData['email'], $jsonData['phone']);
        // //     //             $item['userType'] = 'customer';
        // //     //         } else {
        // //     //             throw new Exception("Not valid file name.", 400);
        // //     //         }
        // //     //     }
        // //     // }

        // //     $newJsonContent = json_encode($jsonData, JSON_PRETTY_PRINT);

        // //     $tempFilePath = sys_get_temp_dir()."\\".$file['name'];
        // //     {
        // //         $tempFile = fopen($tempFilePath, "w");
        // //         file_put_contents($tempFilePath, $newJsonContent);    
        // //     }
        // //     unlink($tempFilePath);

        // //     $fileArray = ['name' => $file['name'], 'tmp_name' => $tempFilePath];

        // //     return move_uploaded_file($fileArray['tmp_name'], "/userData");
        // // }
    }

?>