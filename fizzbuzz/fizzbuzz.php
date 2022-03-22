<?php
namespace hr;

/**
 *
 * Task: Given is the following FizzBuzz application which counts from 1 to 100 and outputs either the corresponding
 * number or if one of the following rules apply output the corresponding text.
 * Rules:
 *  - dividable by 3 without a remainder -> Fizz
 *  - dividable by 5 without a remainder -> Buzz
 *  - dividable by 3 or 5 without a remainder -> FizzBuzz
 *
 * Please refactor this code so that it can be extended in the future with other rules, such as
 * "if it is dividable by 7 without a remainder output Bar"
 * "if multiplied by 10 is larger than 100 output Foo"
 *
 */


class FizzBuzzEngine
{

    public function run($limit = 100)
    {
        for ($i = 1; $i <= $limit; $i++) {
            $output = '';
            if ($i % 3 == 0) {
                $output .= "Fizz";
            }
            if ($i % 5 == 0) {
                $output .= "Buzz";
            }
            if (empty($output)) {
                $output = 'None';
            }
            echo sprintf('%d: %s', $i, $output . PHP_EOL);
        }
    }
}

$engine = new FizzBuzzEngine();
$engine->run();
