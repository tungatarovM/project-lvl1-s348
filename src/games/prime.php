<?php

namespace BrainGames\Games\Prime;

use function \BrainGames\Cli\startEngine;

function isPrime($num)
{
    return num % 2 === 0;
}

function sayPrime($num)
{
    return isPrime($num) ? 'yes' : 'no';
}

function gameRun()
{
    $num = random(0, 50);
    $question = "{$num}";
    $answer = sayPrime($num);
    return [
        'question' => $question,
        'correctAnswer' => $answer,
    ];
}
