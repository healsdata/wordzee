<?php

use Healsdata\Wordzee\Scorer;
use Healsdata\Wordzee\WordFinder;

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

$finder = new WordFinder("data/scrabble-words-7.txt");
$scorer = new Scorer(json_decode(file_get_contents("data/tile-scores.json"), true));

$words = $finder->findSpellableWith("ylodegi");

$wordsByScore = [];

foreach ($words as $word) {
    $score = $scorer->scoreWord($word);

    if (!array_key_exists($score, $wordsByScore)) {
        $wordsByScore[$score] = [];
    }

    $wordsByScore[$score][] = $word;
}

print_r($wordsByScore);