<?php

namespace Healsdata\Wordzee;

class WordFinder
{
    private string $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function findSpellableWith($letters): array
    {
        $letters = strtoupper($letters);
        $lcount = count_chars($letters, 1);

        $output = [];

        $handle = fopen($this->file, "r");
        if (!$handle) {
            throw new \InvalidArgumentException();
        }

        while (($line = fgets($handle)) !== false) {
            $word = trim($line);

            $wcount = count_chars($word, 1);
            foreach ($wcount as $letter => $count) {
                if (!array_key_exists($letter, $lcount)) {
                    continue 2;
                }

                if ($count > $lcount[$letter]) {
                    continue 2;
                }
            }

            $output[] = $word;
        }

        fclose($handle);

        return $output;
    }
}