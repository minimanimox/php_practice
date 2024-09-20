<?php 
    class Drug {
        protected $id;
        protected $dname;
        protected $dcompany;
        protected $amount;
        protected $price;

        function __construct(int $id, string $dname, string $dcompany, float $amount, float $price) {
            $this->id = $id;
            $this->dname = $dname;
            $this->dcompany = $dcompany;
            $this->amount = $amount;
            $this->price = $price;
        }

        function display_info() : array {
            $outputArray = [];
            foreach($this as $key => $val) {
                if($key == "id") {
                    continue;
                }
                
                $outputArray[$key] = $val; 
            }
            return $outputArray;
        }
    }

?>