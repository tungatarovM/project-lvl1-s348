<?php

namespace BrainGames\Cli;

use function \cli\line;
use function \cli\prompt;

const LIVE_POINTS = 3;

function greeting()
{
    line("Welcome to the Brain Games! \n");
    $name = prompt("May I have your name?");
    line("Hello {$name}");
}

function startEngine($gameData, $gameRules)
{
    line("Welcome to the Brain Games! \n");
    line("{$gameRules}");
    $playerName = prompt("May I have your name?");
    line("Hello {$playerName}");
    
    for ($attempt = 0; $attempt < LIVE_POINTS; $attempt = $attempt + 1) {
        ['question' => $question, 'correctAnswer' => $correctAnswer] = $gameData();

        line("Question: {$question}");
        $playersAnswer = prompt("Your answer");

        if ($playersAnswer === $correctAnswer) {
            line("Correct!");
        } else {
            line("'{$playersAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'");
            line("Let's try again {$playerName}");
            return;
        }
    }
    return line("Congratulations {$playerName}");
}
