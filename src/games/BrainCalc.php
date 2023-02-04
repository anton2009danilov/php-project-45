<?php

namespace BrainGames\Games\BrainCalc;

use function BrainGames\Engine\buildGame;
use function BrainGames\Utils\generateRandomNum;

function calcAnswer($questData)
{
    [$num1, $num2, $sign] = $questData;

    switch ($sign) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        default:
            break;
    }

    return $result;
}

function generateSign()
{
    $signs = ['+', '-', '*'];
    $random = generateRandomNum(count($signs) - 1);

    return $signs[$random];
}

function runGame()
{
    $gameName = 'brain-calc';

    buildGame($gameName, function () {
        $num1Limit = 100;
        $num2Limit = 10;
        $num1 = generateRandomNum($num1Limit);
        $num2 = generateRandomNum($num2Limit);
        $sign = generateSign();

        $questData = [$num1, $num2, $sign];

        return [calcAnswer($questData), $questData];
    });
}
