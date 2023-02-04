<?php

namespace BrainGames\Utils;

function generateRandomNum($maxValue, $minValue = 0)
{
    return rand($minValue, $maxValue);
}
