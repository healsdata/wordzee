<?php

namespace Healsdata\Wordzee;

class Scorer
{
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
}