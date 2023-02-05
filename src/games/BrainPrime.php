<?php

namespace BrainGames\Games\BrainPrime;

use function BrainGames\Engine\buildGame;
use function BrainGames\Utils\generateRandomNum;

function isPrime(int $num)
{
    if ($num <= 1) {
        return false;
    }

    if ($num === 2) {
        return true;
    }

    for ($i = 2, $max = $num / 2; $i <= $max; $i += 1) {
        if ($num % $i === 0) {
            return false;
        }
    }

    return true;
}

function calcAnswer(int $num)
{
    return isPrime($num) ? 'yes' : 'no';
}

function runGame()
{
    $gameName = 'brain-prime';

    buildGame($gameName, function () {
        $digitCapacity = 100;
        $num = generateRandomNum($digitCapacity);

        return [calcAnswer($num), [$num]];
    });
}
