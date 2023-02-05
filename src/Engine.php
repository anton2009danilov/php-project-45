<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\sayHello;
use function BrainGames\Cli\askQuestion;

function generateBrainEvenText(int $num)
{
    $description = 'Answer "yes" if the number is even, otherwise answer "no".';
    $task = "Question: {$num}";

    return "{$description}\n{$task}\n";
}

function generateBrainCalcText(array $questData)
{
    [$num1, $num2, $sign] = $questData;
    $description = 'What is the result of the expression?';
    $task = "Question: {$num1} {$sign} {$num2}";

    return "{$description}\n{$task}\n";
}

function generateBrainGCDText(array $questData)
{
    [$num1, $num2] = $questData;
    $description = 'Find the greatest common divisor of given numbers.';
    $task = "Question: {$num1} {$num2}";

    return "{$description}\n{$task}\n";
}

function generateBrainProgressionText(string $questString)
{
    $description = 'What number is missing in the progression?';
    $task = "Question: {$questString}";

    return "{$description}\n{$task}\n";
}

function generateBrainPrimeText(int $num)
{
    $description = 'Answer "yes" if given number is prime. Otherwise answer "no".';
    $task = "Question: {$num}";

    return "{$description}\n{$task}\n";
}

function generateQuestionText(string $gameName, array $questData)
{
    $answerRequestStr = 'Your answer';
    $questText = -1;

    switch ($gameName) {
        case 'brain-even':
            [$num] = $questData;
            $taskDescription = generateBrainEvenText($num);
            $questText = "{$taskDescription}{$answerRequestStr}";
            break;
        case 'brain-prime':
            [$num] = $questData;
            $taskDescription = generateBrainPrimeText($num);
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
        case 'brain-progression':
            [$questString] = $questData;
            $taskDescription = generateBrainProgressionText($questString);
            $questText = "{$taskDescription}{$answerRequestStr}";
            break;
        default:
            break;
    }

    return $questText;
}

function buildGame(string $gameName, callable $generateQuest)
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
