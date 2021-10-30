<?php

namespace Healsdata\Wordzee;

class Scorer
{
    const lineMultipliers = [
        "D" => 2,
        "T" => 3
    ];

    private array $letterScores = [];

    public function __construct(array $letterScores)
    {
        $this->letterScores = $letterScores;
        foreach ($this->letterScores as $letter => $score) {
            $this->letterScores[strtoupper($letter)] = $score;
            $this->letterScores[strtolower($letter)] = $score;
        }
    }

    public function scoreWord($word) : int
    {
        $score = 0;

        foreach (str_split($word) as $letter) {
            if (!array_key_exists($letter, $this->letterScores)) {
                continue;
            }

            $score += $this->letterScores[$letter];
        }

        return $score;
    }

    public function scorePotentialPlay(PotentialPlay $potentialPlay) : void
    {
        $score = 0;
        $multiplier = 1;

        $wordChunks = str_split($potentialPlay->getWord());
        $lineChunks = str_split($potentialPlay->getLine());

        $potentialPlay->setIsFull(sizeof($wordChunks) === sizeof($lineChunks));

        foreach ($wordChunks as $i => $letter) {
            if (!array_key_exists($letter, $this->letterScores)) {
                continue;
            }

            $letterScore = $this->letterScores[$letter];

            $slot = $lineChunks[$i];

            if (is_numeric($slot)) {
                $score += ($letterScore * $slot);
            } elseif (array_key_exists($slot, self::lineMultipliers)) {
                $score += $letterScore;
                $multiplier *= self::lineMultipliers[$slot];
            }
        }

        $score *= $multiplier;

        $potentialPlay->setScore($score);
    }
}