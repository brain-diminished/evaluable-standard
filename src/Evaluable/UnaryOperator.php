<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Basic implementation of a generic unary operator, based on PHP native operators.
 */
class UnaryOperator implements Evaluable
{
    /** @var string */
    private $operator;

    /** @var Evaluable */
    private $arg;

    public function __construct(string $operator, Evaluable $arg)
    {
        $this->operator = $operator;
        $this->arg = $arg;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        switch ($this->operator) {
            case '!': return !$this->arg->evaluate($context);
            case '~': return ~$this->arg->evaluate($context);
            case '+': return +$this->arg->evaluate($context);
            case '-': return -$this->arg->evaluate($context);
            default:
                throw new \RuntimeException("Unary operator `$this->operator` could not be resolved");
        }
    }
}
