<?php
namespace BrainDiminished\Evaluable\Standard\Arity;

use BrainDiminished\Evaluable\Compiler\Context\OperatorArity;

class OperatorMultipleArity implements OperatorArity
{
    /** @var string */
    public $separator;

    /** @var string */
    public $delimiter;

    /** @var int */
    private $leftPriority;

    /** @var bool */
    private $allowNoArg;

    public function __construct(string $separator, string $delimiter, int $leftPriority = 0, bool $allowNoArg = true)
    {
        $this->separator = $separator;
        $this->delimiter = $delimiter;
        $this->leftPriority = $leftPriority;
        $this->allowNoArg = $allowNoArg;
    }

    public function isFixed(int &$argc = null): bool
    {
        return false;
    }

    public function isPlural(string &$separator = null): bool
    {
        $separator = $this->separator;
        return true;
    }

    public function isClosed(string &$delimiter = null): bool
    {
        $delimiter = $this->delimiter;
        return true;
    }

    public function allowNoArg(): bool
    {
        return $this->allowNoArg;
    }

    public function getLeftPriority(): int
    {
        return $this->leftPriority;
    }

    public function getRightPriority(): int
    {
        return -1;
    }
}