<?php
// https://adventofcode.com/2021/day/4

$input = "7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1

22 13 17 11  0
 8  2 23  4 24
21  9 14 16  7
 6 10  3 18  5
 1 12 20 15 19

 3 15  0  2 22
 9 18 13 17  5
19  8  7 25 23
20 11 10 24  4
14 21 16 12  6

14 21 17 24  4
10 16 15  9 19
18  8 23 26 20
22 11 13  6  5
 2  0 12  3  7";

$input = explode("\n\n", $input);

$numbers = explode(",", $input[0]);
$bingocards = array_slice($input, 1);

foreach($bingocards as $key => $bingocard) {
    $bingocards[$key] = array_map(function($value) {
        return array_map("trim", str_split($value, 3));
    }, explode("\n", $bingocard));
}

foreach($numbers as $i => $number) {
    $currentnumbers = array_slice($numbers, 0, $i + 1);
    echo "Bingo found in bingo card ";
    foreach($bingocards as $i => $bingocard) {

        if(isBingo($bingocard, $currentnumbers)) {
            echo "$i,";
            unset($bingocards[$i]);

            $total_unmarked = 0;
            foreach($bingocard as $row) {
                foreach ($row as $column) {
                    if(!in_array($column, $currentnumbers)) {
                        $total_unmarked += $column;
                    }
                }
            }

            echo "Total sum unmarked numbers: $total_unmarked\n";
            echo "Multiplied: ".($total_unmarked*$number);
        }
    }

    echo "\n";
}


function isBingo(array $bingocard, array $numbers) : bool {
    for($i = 0; $i < 5; $i++) {
        // horizontal
        if(count(array_intersect($bingocard[$i], $numbers)) == 5) {
            return true;
        }

        // vertical
        if(count(array_intersect([$bingocard[0][$i], $bingocard[1][$i], $bingocard[2][$i], $bingocard[3][$i], $bingocard[4][$i]], $numbers)) == 5) {
            return true;
        }
    }

    return false;
}