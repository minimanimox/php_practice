<?php 
    echo "test";
    function Chunker(array $srcArray, float $size): Array { // no using methods
        $result = [];
        
        foreach ($srcArray as $item) {

        }
        return $result;
    }

    function Differ(array $srcArray, array $srcArray2): array { //make differ method without using methods
        $result = [];
    
        foreach ($srcArray as $item) {
            $itemfound = false; //default
            foreach ($srcArray2 as $item2) {
                if ($item == $item2) {
                    $itemfound = true;
                    break;
                }
            }
            if (!$itemfound) {
                $result[] = $item;
            }
        }
    
        return $result;
    }
    
    

    function Splicer(array $srcArray, $startIdx, $rmvLength, $repArray = null): Array { //$repArray not given
        $result = [];

        foreach ($srcArray as $item) {
            for($i = $startIdx; $i < $rmvLength; $i++) {
                echo $item[$i];
            }

        }

        return $result;
    }

    function repDel(array $srcArray): array {
        $result = [];
        array_push($result, $srcArray[0]); // first number is always in the array
    
        for ($i = 1; $i < count($srcArray); $i++) {  //I couldn't find other way without using count($srcArray)
            $numCheck = false;
            for ($j = 0; $j < count($result); $j++) {
                if ($srcArray[$i] === $result[$j]) {
                    $numCheck = true;
                    break;
                }
            }
            if (!$numCheck) {
                array_push($result, $srcArray[$i]);
            }
        }
    
        return $result;
    }    

    $names = ["Mina", "Victor", "John", "Robinson", "Jun", "Jisun"];
    print_r(Splicer($names, 2, 1));

    $testArray = [1,2,1,4,2,3];
    print_r(repDel($testArray));
    
    $nums = [1,2,3,4];
    $nums2 = [1,5,6];
    print_r(Differ($nums, $nums2));

?>