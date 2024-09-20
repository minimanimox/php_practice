<?php
    class DbClass{
        private $dbSever;
        private $dbUser;
        private $dbName;
        private $dbPass;
        public $dbCon;
        function __construct($dbSever,$dbUser,$dbPass,$dbName)
        {
            $this->dbSever = $dbSever;
            $this->dbName = $dbName;
            $this->dbPass = $dbPass;
            $this->dbUser = $dbUser;
            $this->dbCon = $this->dbConnect();
        }
        private function dbConnect(){
            $dbCon = new mysqli($this->dbSever,$this->dbUser,$this->dbPass,$this->dbName);
            if($dbCon->connect_error){
                throw new Exception("DB Connection Error ".$dbCon->connect_error,500);
            }
            return $dbCon;
        }
        public function Insert(string $tbName,array $colArray, array $valArray){
            $Cols = implode(",",$colArray);
            $Fields = str_repeat("?,",count($colArray)-1)."?";
            $insQuery = $this->dbCon->prepare("INSERT INTO $tbName ($Cols) VALUES ($Fields)");
            $paramType = "";
            foreach($valArray as $val){
                $paramType .= gettype($val)=="boolean"?"i":gettype($val)[0];
            }
            $insQuery->bind_param($paramType,...$valArray);
            if($insQuery->execute()){
                $insQuery->close();
                echo "Record added!";
            }else{
                $this->Close_connection($insQuery);
                throw new Exception("Record not added!",500);
            }
        }
        // $selectQuery = $dbCon->prepare("SELECT * FROM user_tb WHERE email=?");
        // $selectQuery->bind_param("s",$inputArray["email"]);
        // ["cols"=>['email','pass'],vals=>['test@mail.com','test12'],operator=>["=","="],operand=>["AND"]] 
        // just an example: SELECT $Cols FROM $tbName WHERE email=? AND pass=?
        public function Select(string $tbName,array $whereArray=[],array $colArray=[]){
            $Cols = (count($colArray)>0)?implode(",",$colArray):"*";
            $whereCl = "";
            if(count($whereArray)>0){
                $whereCl .= " WHERE ";
                $operand = (isset($whereArray["operand"])) ? $whereArray["operand"] : "";
                for($idx=0;$idx < count($whereArray["cols"]);$idx++){
                    $whereCl .= $whereArray["cols"][$idx].$whereArray["operator"][$idx]."?";
                    if($idx==count($whereArray["cols"])-1){
                        break;
                    }
                    $whereCl .= $operand!=""? " $operand ":"";
                }
            }
            $selectQuery = $this->dbCon->prepare("SELECT $Cols FROM $tbName $whereCl");
            $paramType = "";
            foreach($whereArray["vals"] as $val){
                $paramType .= gettype($val)=="boolean"?"i":gettype($val)[0];
            }
            $selectQuery->bind_param($paramType,...$whereArray["vals"]);
            if($selectQuery->execute()){
                $result = $selectQuery->get_result();
                return $result;
            }else{
                $this->Close_connection($selectQuery);
                throw new Exception("Error in reading data!",500);
            }
        }
        public function Close_connection($prepared_con=null){
            if($prepared_con!=null){
                $prepared_con->close();
            }
            $this->dbCon->close();
        }
    }
?>