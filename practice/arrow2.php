<?php 
    class Student {
        public $name;
        private $grades = array();
        
        function __construct(string $name)
        {
            $this->name = $name;
        }

        public function addGrade($subject, $grade) {
            $this->grades[$subject] = $grade;
        }

        public function getGrades() {
            return $this->grades;
        }

        public function getAverageGrade() {
            $total = 0;
            $count = count($this->grades);

            foreach ($this->grades as $grade) {
                $total += $grade;
            }
            
            return $count > 0 ? $total / $count : 0;
        }
    }

    class School {
        private $students = array();

        public function addStudent($student) {
            $this->students[] = $student;
        }

        public function listStudent() {
            foreach ($this->students as $student) {
                echo "학생명: ".$student->name.", 평균 성적: ".number_format($student->getAverageGrade(),2),"\n";
            }
        }
    }

    //test 
    $school = new School();

    $student1 = new Student("Alice");
    $student1->addGrade("Math", 90);
    $student1->addGrade("Science", 80);

    $student2 = new Student("Bob");
    $student2->addGrade("Math", 95);
    $student2->addGrade("Science", 90);

    $school->addStudent($student1);
    $school->addStudent($student2);

    $school->listStudent();
?>