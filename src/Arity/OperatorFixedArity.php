<?php
namespace BrainDiminished\Evaluable\Standard\Arity;

use BrainDiminished\Evaluable\Compiler\Context\OperatorArity;

/**
 * Class OperatorFixedArity
 * @package BrainDiminished\Evaluable\Compiler\Context\Arity
 */
class OperatorFixedArity implements OperatorArity
{
    /** @var string */
    public $separator;

    /** @var string */
    public $delimiter;

    /** @var int */
    public $argc;

    /** @var int */
    private $rightPriority;

    /** @var int */
    private $leftPriority;

    public function __construct(int $argc, int $rightPriority, int $leftPriority = 0, string $separator = null, string $delimiter = null)
    {
        $this->argc = $argc;
        $this->separator = $separator;
        $this->delimiter = $delimiter;
        $this->rightPriority = $rightPriority;
        $this->leftPriority = $leftPriority;
        if ($this->argc > 1 && empty($this->separator)) {
            throw new \LogicException("A plural arity must declare a non empty separator");
        }
        if ($this->argc >= 1 && empty($this->delimiter) && $this->rightPriority === null) {
            throw new \LogicException("A non closed operator must have a non null right priority");
        }
    }

    public function isFixed(int &$argc = null): bool
    {
        $argc = $this->argc;
        return true;
    }

    public function isPlural(string &$separator = null): bool
    {
        $separator = $this->separator;
        return $this->argc > 1;
    }

    public function isClosed(string &$delimiter = null): bool
    {
        if (!empty($this->delimiter)) {
            $delimiter = $this->delimiter;
            return true;
        }
        return false;
    }

    public function getLeftPriority(): int
    {
        return $this->leftPriority;
    }

    public function getRightPriority(): int
    {
        return $this->isClosed() ? -1 : $this->rightPriority;
    }

    public function allowNoArg(): bool
    {
        return $this->argc <= 0;
    }
}