<?php 
    function bubblesort(array $array){
        $array_len = count($array);
        for ($i=0; $i < $array_len - 1; $i++) {
            for ($j = 0; $j < $array_len - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j+1];
                $array[$j+1] = $temp;
                }
            }
        }
        return $array;
    }
    $numbers = [2, 10, 4, 3, 50, 70];
    
    print_r(bubblesort($numbers));
?>