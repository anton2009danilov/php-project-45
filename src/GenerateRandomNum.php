<?php

namespace BrainGames\Utils;

function generateRandomNum(int $maxValue, int $minValue = 0)
{
    return rand($minValue, $maxValue);
}
