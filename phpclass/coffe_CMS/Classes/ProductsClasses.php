<?php
    interface shopInterface{
        public function cost_cal(int $sold_amount) : float;
        public function amount_cal(int $sold_amount) : float;
    }
    define("SIZE",["s"=>"Small","r"=>"Regular","l"=>"Large","g"=>"Grande"]);
    abstract class Product{
        protected $pcode;
        protected $pname;
        protected $price;
        function __construct(int $pcode,string $pname, string $price)
        {
            $this->pcode = $pcode;
            $this->pname = $pname;
            $this->price = $price;
        }
        abstract protected function display_info() : array;
    }
    class Store_product extends Product implements shopInterface{
        private $amount;
        function __construct(int $pcode,string $pname, string $price, float $amount)
        {
            parent::__construct($pcode,$pname,$price);
            $this->amount = $amount;
        }
        function display_info(): array
        {
            $outputArray = [];
            foreach(['pcode','pname','price','amount'] as $key){
                $outputArray += [$key=>$this->$key];
            }
            return $outputArray;
        }
        function cost_cal(int $sold_amount): float
        {
            return $this->price * $sold_amount;
        }
        function amount_cal(int $sold_amount): float
        {
            $this->set_amount($this->amount - $sold_amount);
            return $this->amount;
        }
        function set_amount($newAmount){
            if($newAmount > 0){
                $this->amount = $newAmount;
            }
        }
    }
    class Drink extends Product{
        protected $selected_size;
        function __construct(int $pcode,string $pname, string $price, string $size)
        {
            parent::__construct($pcode,$pname,$price);
            $this->selected_size = SIZE[$size];
        }
        function display_info(): array
        {
            $outputArray = [];
            foreach(['pcode','pname','price','selected_size'] as $key){
                $outputArray += [$key=>$this->$key];
            }
            return $outputArray;
        }
    }
?>