<?php

namespace BrainGames\Games\BrainEven;

use function BrainGames\Engine\buildGame;
use function BrainGames\Utils\generateRandomNum;

function isEven($num)
{
    return $num % 2 === 0;
}

function calcAnswer($num)
{
    return isEven($num) ? 'yes' : 'no';
}

function runGame()
{
    $gameName = 'brain-even';

    buildGame($gameName, function () {
        $digitCapacity = 1000;
        $num = generateRandomNum($digitCapacity);

        return [calcAnswer($num), $num];
    });
}
