<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\sayHello;
use function BrainGames\Cli\askQuestion;

function generateBrainEvenText($num)
{
    $description = 'Answer "yes" if the number is even, otherwise answer "no".';
    $task = "Question: {$num}";

    return "{$description}\n{$task}\n";
}

function generateBrainCalcText($questData)
{
    [$num1, $num2, $sign] = $questData;
    $description = 'What is the result of the expression?';
    $task = "Question: {$num1} {$sign} {$num2}";

    return "{$description}\n{$task}\n";
}

function generateBrainGCDText($questData)
{
    [$num1, $num2] = $questData;
    $description = 'Find the greatest common divisor of given numbers.';
    $task = "Question: {$num1} {$num2}";

    return "{$description}\n{$task}\n";
}

function generateQuestionText($gameName, $questData = '123')
{
    $answerRequestStr = 'Your answer';

    switch ($gameName) {
        case 'brain-even':
            $taskDescription = generateBrainEvenText($questData);
            $questText = "{$taskDescription}{$answerRequestStr}";
            break;
        case 'brain-calc':
            $taskDescription = generateBrainCalcText($questData);
            $questText = "{$taskDescription}{$answerRequestStr}";
            break;
        case 'brain-gcd':
            $taskDescription = generateBrainGCDText($questData);
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

        if ((string) $userAnswer === (string) $correctAnswer) {
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
