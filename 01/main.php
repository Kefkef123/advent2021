<?php
// https://adventofcode.com/2021/day/1
$input = [
    199,
    200,
    208,
    210,
    200,
    207,
    240,
    269,
    260,
    263,
];

$counter = 0;

array_walk($input, function($value, $index) use (&$counter, $input) {
    if($index < 3) {
        return;
    }

    $currentValue = 0;
    $previousValue = 0;

    if($index > 1) {
        $currentValue = $input[$index - 2] + $input[$index - 1] + $value;
    }

    if($index > 2) {
        $previousValue = $input[$index - 3] + $input[$index - 2] + $input[$index - 1];
    }

    if($currentValue > $previousValue) {
        $counter++;
    }

});

echo $counter;