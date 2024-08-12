<?php 
    class User{
        //properties(attributes)
        private $uid; //public private protected
        protected $fname;
        protected $lname;
        protected $role;
        protected $email;
        protected $phone;
        function __construct(int $uid, string $fname, string $lname, string $role, string $email, string $phone=null)  //just one allowed, optional is null
        {
            $this->uid = $uid;  //$this는 PHP에서 현재 객체를 가리키는 키워드
            $this->fname = $fname;
            $this->lname = $lname;
            $this->role = $role;
            $this->email = $email;
            $this->phone = $phone;
        }
        function display_info():void{
            $outputArray = [];
            foreach($this as $key=>$val) {
                if($key == "uid") continue;
                $outputArray += [$key=>$val];
            }
            echo json_encode($outputArray);
            // foreach($this as $key=>$val){
            //     echo "$key=>$val";
            // }
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $customer = new User(1,'Jun','Diego','customer','test@mail.com',);
        print_r($customer->display_info());
    } else {
        http_response_code(405);
        echo "Bad Request!";
    }

?>