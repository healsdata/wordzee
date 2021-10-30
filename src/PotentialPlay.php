<?php

namespace Healsdata\Wordzee;

class PotentialPlay
{
    private string $word;
    private string $line;

    public function __construct(string $word, string $line)
    {
        $this->word = $word;
        $this->line = $line;
    }

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @return string
     */
    public function getLine(): string
    {
        return $this->line;
    }

}