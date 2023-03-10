<?php

namespace BrainGames\Games\BrainGreatestCommonDivisor;

use function BrainGames\Engine\buildGame;
use function BrainGames\Utils\generateRandomNum;

function findGreatestCommonDivisor(int $num1, int $num2)
{
    $maxDivisor = $num1 >= $num2 ? $num1 : $num2;
    $minDivisor = 1;
    $result = -1;

    if ($num1 % $maxDivisor === 0 && $num2 % $maxDivisor === 0) {
        $result = $maxDivisor;
    } else {
        $maxDivisor = (int) ($maxDivisor / 2);

        for ($i = $maxDivisor; $i >= $minDivisor; $i -= 1) {
            if ($num1 % $i === 0 && $num2 % $i === 0) {
                $result = $i;
                break;
            }
        }
    }

    return (string) $result;
}

function calcAnswer(array $questData)
{
    [$num1, $num2] = $questData;

    return findGreatestCommonDivisor($num1, $num2);
}

function runGame()
{
    $gameName = 'brain-gcd';

    buildGame($gameName, function () {
        $digitCapacity = 100;
        $minValue = 1;
        $num1 = generateRandomNum($digitCapacity, $minValue);
        $num2 = generateRandomNum($digitCapacity, $minValue);

        $questData = [$num1, $num2];

        return [calcAnswer($questData), $questData];
    });
}
