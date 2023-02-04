<?php

namespace BrainGames\BuildGame;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\sayHello;
use function BrainGames\Cli\askQuestion;

function generateBrainEvenText($num)
{
    $description = 'Answer "yes" if the number is even, otherwise answer "no".';
    $task = "Question: {$num}\n";

    return "{$description}\n{$task}";
}

function generateQuestionText($gameName, $questData = '123')
{
    $answerRequestStr = 'Your answer';

    switch ($gameName) {
        case 'brain-even':
            $taskDescription = generateBrainEvenText($questData);
            $questText = "{$taskDescription}{$answerRequestStr}";
            break;
        default:
            break;
    }

    return $questText;
}

function buildGame($gameName, $generateQuest)
{
    $roundsLimit = 3;
    $userName = sayHello();

    for ($i = 1; $i <= $roundsLimit; $i += 1) {
        [$correctAnswer, $questData] = $generateQuest();
        $userAnswer = askQuestion(generateQuestionText($gameName, $questData));

        if ($userAnswer === $correctAnswer) {
            line('Correct!');

            if ($i === $roundsLimit) {
                line("Congratulations, {$userName}!");
            }
        } else {
            line("'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.\n");
            line("Let's try again, {$userName}!");
            break;
        }
    }
}
