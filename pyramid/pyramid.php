<?php
/*

    *
   ***
  *****
 *******
*********

Write a script to output this pyramid on console (with leading spaces)

*/

function pyramid($height)
{
    for ($outerIter=0; $outerIter<$height; $outerIter++){
        for ($x = 0; $x <= ($height-($outerIter+2)); $x++) {
            echo(" ");
        }
        for ($y = 0; $y <= 2 * ($outerIter); $y++) {
            echo("*");
        }
        echo(PHP_EOL);
    }
}

pyramid(5);
