<?php

use Healsdata\Wordzee\PotentialPlay;
use Healsdata\Wordzee\Scorer;
use Healsdata\Wordzee\WordFinder;

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

$finder = new WordFinder("data/scrabble-words-7.txt");
$scorer = new Scorer(json_decode(file_get_contents("data/tile-scores.json"), true));

if (!array_key_exists(1, $argv)) {
    exit("Please provide the 7 playable letters as the last parameter.");
}

$letters = array_pop($argv);

if (strlen($letters) !== 7) {
    exit("Please provide the 7 playable letters as the last parameter.");
}


$lines = [];

if (sizeof($argv) > 1) {
    foreach ($argv as $i => $value) {
        if ($i < 1) {
            continue;
        }

        $lines[] = $value;
    }
}

if (!sizeof($lines)) {
    $lines[] = "1111111";
}

$words = $finder->findSpellableWith($letters);


$scoredPlays = [];

foreach ($words as $word) {
    foreach ($lines as $line) {
        if (strlen($word) > strlen($line)) {
            continue;
        }

        $potentialPlay = new PotentialPlay($word, $line);

        $score = $scorer->scorePotentialPlay($potentialPlay);

        $potentialPlay->setScore($score);

        $scoredPlays[] = $potentialPlay;
    }
}

usort($scoredPlays, function (PotentialPlay $playA, PotentialPlay $playB){
    return $playB->getScore() - $playA->getScore();
});

$out = 0;
foreach ($scoredPlays as $scoredPlay) {
    print $scoredPlay . PHP_EOL;
    $out++;

    if ($out >= 10) {
        break;
    }
}