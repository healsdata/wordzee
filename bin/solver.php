<?php

use Healsdata\Wordzee\WordFinder;

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

$finder = new WordFinder("data/scrabble-words-7.txt");

$words = $finder->findSpellableWith("SASATEC");

print_r($words);