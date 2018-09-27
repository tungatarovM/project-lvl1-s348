<?php

namespace BrainGames\Games\Progression;

use function \BrainGames\Cli\startEngine;

const PROGRESSION_GAME_RULES = 'What number is missing in this progression?';

function mkSequence()
{
    $sequenceLength = 9;
    $startNum = rand(0, 100);
    $range = rand(0, 100);
    $missedNumIndex = rand(0, $sequenceLength);
    $sequence = [];

    for ($index = 0; $index < $sequenceLength; $index++) {
        if ($index === $missedNumIndex) {
            $sequence[$index] = '..';
        } else {
            $sequence[$index] = $startNum + ($range * $index);
        }
    }
    return [
        'sequence' => $sequence,
        'range' => $range,
        'startNum' => $startNum,
        'missedNumIndex' => $missedNumIndex,
        'sequenceLength' => $sequenceLength,
    ];
}

function toStr($sequenceObj)
{
    [ 'sequence' => $sequence] = $sequenceObj;
    return implode(' ', $sequence);
}

function getMissedNum($sequenceObj)
{
    [
        'sequence' => $sequence,
        'missedNumIndex' => $missedNumIndex,
        'startNum' => $startNum,
        'range' => $range
    ] = $sequenceObj;
    
    $previousNum = $sequence[$missedNumIndex - 1];

    if ($missedNumIndex === 0) {
        $nextNum = $sequence[$missedNumIndex + 1];
        return $nextNum - $range;
    }
    return $previousNum + $range;
}

function getCorrectAnswer($sequenceObj)
{
    return getMissedNum($sequenceObj);
}

function gameRun()
{
    $gameData = function () {
        $sequenceObj = mkSequence();
        $question = toStr($sequenceObj);
        $answer = getCorrectAnswer($sequenceObj);
        return [
            'question' => $question,
            'correctAnswer' => "{$answer}",
        ];
    };
    return startEngine($gameData, PROGRESSION_GAME_RULES);
}
