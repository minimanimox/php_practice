<?php 
    class User{
        //properties(attributes)
        private $uid; //public private protected
        protected $fname;
        protected $lname;
        protected $role;
        protected $email;
        protected $phone;

        function __construct(int $uid, string $fname, string $lname, string $role, string $email, string $phone=null)  //just one allowed, optional is null 생성자
        {
            $this->uid = $uid;  //$this는 PHP에서 현재 객체를 가리키는 키워드
            $this->fname = $fname;
            $this->lname = $lname;
            $this->role = $role;
            $this->email = $email;
            $this->phone = $phone;
        }
        function display_info() : array {
            $outputArray = [];
            foreach($this as $key => $val) {
                if($key == "uid") continue;
                $outputArray += [$key => $val]; //$outputArray[$key] = $val; 이게 더 명확하고 직관적임
            }
            return $outputArray;
            // foreach($this as $key=>$val){
            //     echo "$key=>$val";
            // }
        }
    }

    class Customer extends User { //inheritance from User
        protected $addr;
        protected $wallet;

        function __construct(int $uid, string $fname, string $lname, string $email, string $addr, float $wallet = 0.0, string $phone=null) 
        {
            //get rid of string $role from __contstruct and add this
            parent::__construct($uid, $fname, $lname, 'c', $email, $phone); //it has orders
            $this->addr = $addr;
            $this->wallet = $wallet;
        }

        function display_info(): array 
        {
            $outputArray = parent::display_info();
            foreach (["addr", "wallet"] as $key) {
                $outputArray += [$key=>$this->$key]; //키=>값 형태를 추가하는 구문
            }
            return $outputArray;
        }
    }

    class Staff extends User {
        protected $startDate;
        protected $status;
        protected $addr;

        function __construct(int $uid, string $fname, string $lname, string $email, string $addr, string $startDate, string $status, string $phone=null)
        {
            parent::__construct($uid, $fname, $lname, "s", $email, $phone);
            $this->addr = $addr;
            $this->startDate = $startDate;
            $this->status = $status;
        }

        function display_info():array 
        {
            $outputArray = parent::display_info();
            foreach (["startDate", "status"] as $key) {
                $outputArray += [$key=>$this->$key];
            }
            return $outputArray;
        }
    }
?>