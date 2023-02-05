<?php

namespace BrainGames\Games\BrainProgression;

use function BrainGames\Engine\buildGame;
use function BrainGames\Utils\generateRandomNum;

function runGame()
{
    $gameName = 'brain-progression';

    buildGame($gameName, function () {
        $digitCapacity = 100;
        $newNum = generateRandomNum($digitCapacity);

        $stepBottomLimit = 1;
        $stepTopLimit = 21;
        $step = generateRandomNum($stepTopLimit, $stepBottomLimit);

        $maxLength = 10;
        $minLength = 5;
        $length = generateRandomNum($maxLength, $minLength);
        $secretNumPosition = generateRandomNum($length - 1);

        $progression = [];

        for ($position = 0; $position < $length; $position += 1) {
            if ($position === $secretNumPosition) {
                $progression[] = '..';
                $secretNum = $newNum;
            } else {
                $progression[] = $newNum;
            }

            $newNum += $step;
        }

        return [$secretNum, implode(' ', $progression)];
    });
}
