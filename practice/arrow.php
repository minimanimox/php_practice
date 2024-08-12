<?php
    class Product {
        public $name;
        public $price;
        public $quantity;

        function __construct(string $name, float $price, int $quantity) {
            $this->name = $name;
            $this->price = $price;
            $this->quantity = $quantity;
        }

        function getName() {
            return $this->name;
        }

        function getPrice() {
            return $this->price;
        }

        function getQuantity() {
            return $this->quantity;
        }
    }

    class ShoppingCart {
        private $products = array();

        public function addProduct($product) {
            $this->products[] = $product;
        }

        public function getTotalPrice() {
            $total = 0;

            foreach ($this->products as $product) {
                $total += $product->getPrice() * $product->getQuantity();
            }
            return $total;
        }
        
        public function listProducts() {
            foreach ($this->products as $product) {
                echo "상품명: ".$product->getName().", 가격: ".$product->getPrice()."원, 수량: ".$product->getQuantity()."개\n"; 
            }
        }
    }

    //test code

    $cart = new ShoppingCart();

    $purchase_1 = new Product("Apple", 1000, 3);
    $purchase_2 = new Product("Banana", 500, 2);

    $cart->addProduct($purchase_1);
    $cart->addProduct($purchase_2);

    $cart->listProducts();
    echo "총 가격: ".$cart->getTotalPrice()."원\n";
?>