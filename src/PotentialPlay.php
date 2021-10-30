<?php

namespace Healsdata\Wordzee;

class PotentialPlay
{
    private string $word;
    private string $line;
    private ?int $score = null;
    private bool $isFull = false;

    public function __construct(string $word, string $line)
    {
        if (strlen($word) > strlen($line)) {
            throw new \InvalidArgumentException();
        }

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

    /**
     * @return int|null
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * @param int|null $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * @return bool
     */
    public function isFull(): bool
    {
        return $this->isFull;
    }

    /**
     * @param bool $isFull
     */
    public function setIsFull(bool $isFull): void
    {
        $this->isFull = $isFull;
    }

    public function __toString(): string
    {
        return $this->word . " in " . $this->line . " (" . $this->score . ($this->isFull() ? "!" : "") . ")";
    }
}