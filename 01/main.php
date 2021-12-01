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
    if(isset($input[$index - 1]) && $value > $input[$index - 1]) {
        $counter++;
    }
});

echo $counter;