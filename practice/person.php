<?php
    class Person {
        public $name;
        public $age;

        public function setName($name) {
            $this->name = $name;
        }

        public function getName() {
            return $this->name;
        }

        public function setAge($age) {
            $this->age = $age;
        }

        public function getAge() {
            return $this->age;
        }
    }

    $user = new Person();

    $user->setName("Jinny");
    $user->setAge(30);

    echo "이름: ".$user->getName()."</br>";
    echo "나이: ".$user->getAge();

?>
        