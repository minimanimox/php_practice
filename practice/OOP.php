<?php
    class Car {
        public $color;

        public function setColor($color) {
            $this->color = $color;
        }

        public function getColor() {
            return $this->color;
        }
    }

    //객채 생성
    $newCar = new Car();

    $newCar->setColor("Red");
    
    echo $newCar->getColor();

?>