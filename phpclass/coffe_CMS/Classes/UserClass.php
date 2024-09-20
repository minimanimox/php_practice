<?php
    require("DBClass.php");
    abstract class User{
        protected $uid;
        protected $fname;
        protected $lname;
        protected $role;
        protected $email;
        protected $phone;
        function __construct(int $uid, string $fname, string $lname, string $role, string $email, string $phone=null)
        {
            $this->uid = $uid;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->role = $role;
            $this->email = $email;
            $this->phone = $phone;   
        }
        function display_info():array{
            $outputArray = [];
            foreach($this as $key=>$val){
                if($key == "uid") continue;
                $outputArray += [$key=>$val];
            }
            return $outputArray;
        }
        abstract public function Register(string $pass) : void;
        // abstract public function Login(string $pass) : bool;

    }
    class Customer extends User{
        protected $addr;
        protected $wallet;
        function __construct(string $fname, string $lname, string $email, string $phone=null, string $addr="", float $wallet=0.0,int $uid=0)
        {
            parent::__construct($uid,$fname,$lname,"c",$email,$phone);
            $this->addr = $addr;
            $this->wallet = $wallet;
        }
        function display_info(): array
        {
            $outputArray = parent::display_info();
            foreach(["addr","wallet"] as $key){
                $outputArray += [$key=>$this->$key];
            }
            return $outputArray;
        }
        function Register(string $pass): void
        {
            $dbCon = new DbClass(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $result = $dbCon->Select("user_tb",["cols"=>["email"],"vals"=>[$this->email],"operator"=>["="]]);
            if($result->num_rows>0){
                $dbCon->Close_connection();
                throw new Exception("Record already exists!",406);
            }
            $pass = password_hash($pass,PASSWORD_ARGON2I,["cost"=>12]);
            $dbCon->Insert("user_tb",["fname","lname","role","email","pass","phone"],[$this->fname,$this->lname,$this->role,$this->email,$pass,$this->phone]);
            $result = $dbCon->Select("user_tb",["cols"=>["email"],"vals"=>[$this->email],"operator"=>["="]],["uid"]);
            $data = $result->fetch_assoc();
            $dbCon->Insert("customer_tb",["uid","wallet","addr"],[$data["uid"],$this->wallet,$this->addr]);
        }
    }
    class Staff extends User{
        protected $jobID;
        protected $hireDate;
        function __construct(string $fname, string $lname, string $email, string $phone=null, int $jobID=0, string $hireDate="", int $uid=0)
        {
            parent::__construct($uid,$fname,$lname,"s",$email,$phone);
            $this->jobID = $jobID;
            $this->hireDate = $hireDate;
        }
        function display_info(): array
        {
            $outputArray = parent::display_info();
            foreach(["jobTitle","salary","hireDate"] as $key){
                $outputArray += [$key=>$this->$key];
            }
            return $outputArray;
        }
        function Register(string $pass): void
        {
            $dbCon = new DbClass(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $result = $dbCon->Select("user_tb",["cols"=>["email"],"vals"=>[$this->email],"operator"=>["="]]);
            if($result->num_rows>0){
                $dbCon->Close_connection();
                throw new Exception("Record already exists!",406);
            }
            $pass = password_hash($pass,PASSWORD_ARGON2I,["cost"=>12]);
            $dbCon->Insert("user_tb",["fname","lname","role","email","pass","phone"],[$this->fname,$this->lname,$this->role,$this->email,$pass,$this->phone]);
            $result = $dbCon->Select("user_tb",["cols"=>["email"],"vals"=>[$this->email],"operator"=>["="]],["uid"]);
            $data = $result->fetch_assoc();
            $dbCon->Insert("hire_tb",["uid","jid","hdate"],[$data["uid"],$this->jobID,$this->hireDate]);
        }
    }
?>