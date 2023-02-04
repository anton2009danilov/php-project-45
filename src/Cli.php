<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

function sayHello()
{
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?', false, ' ');
    line("Hello, %s!", $userName);

    return $userName;
}

function askQuestion($questionText)
{
    return prompt($questionText);
}
