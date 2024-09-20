<?php
    class File{
        private $srcAddr;
        function __construct(string $srcAddr)
        {
            $this->check_file($srcAddr);
            $this->srcAddr = $srcAddr."/";
        }
        private function check_file($addr,$notFlag=true){
            if(($notFlag)?!file_exists($addr):file_exists($addr)){
                throw new Exception(($notFlag)?"Resource not found.":"Resource already exists.",404);
            }
        }
        function read_file(string $fileName):string{
            $dstFile = $this->srcAddr.$fileName;
            $this->check_file($dstFile);
            $file = fopen($dstFile,"r");
            $data = fread($file,filesize($dstFile));
            fclose($file);
            return $data;
        }
        function write_file(string $fileName,string $data):void{
            $dstFile = $this->srcAddr.$fileName;
            $file = fopen($dstFile,"w");
            fwrite($file,$data);
            fclose($file);
        }
        function set_new_workingDir(string $newAddr){
            $this->check_file($newAddr);
            $this->srcAddr = $newAddr."/";
        }
        function create_dir(string $dirName,bool $silent=false):bool{
            $dstAddr = $this->srcAddr.$dirName;
            if(!$silent)
                $this->check_file($dstAddr,false);
            else{
                if(is_dir($dstAddr)){
                    return true;
                }
            }
            return mkdir($dstAddr);
        }
        function remove_dir(string $dirName):bool{
            $dstAddr = $this->srcAddr.$dirName;
            $this->check_file($dstAddr);
            return rmdir($dstAddr);
        }
        function remove_file(string $fileName):bool{
            $dstAddr = $this->srcAddr.$fileName;
            $this->check_file($dstAddr);
            return unlink($dstAddr);
        }
        function read_dir(string $dirName=""){
            $dstAddr = ($dirName=="")?$this->srcAddr:$this->srcAddr.$dirName;
            $this->check_file($dstAddr);
            return array_diff(scandir($dstAddr),[".",".."]);
        }
        function upload_file(array $file,string $dstAddr=""){
            $targetDir = ($dstAddr=="")?$this->srcAddr:$this->srcAddr.$dstAddr."/";
            $fileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            if(array_search($fileType,["jpg","jpeg","bmp","gif"])!==false){
                if(!getimagesize($file['tmp_name'])){
                    throw new Exception("Extension is image but content is not.",406);
                }
            }elseif(array_search($fileType,["pdf","doc","docx","json"])===false){
                throw new Exception("Not a valid file type.",406);
            }
            return move_uploaded_file($file['tmp_name'],$targetDir.$file['name']);
        }
    }
?>