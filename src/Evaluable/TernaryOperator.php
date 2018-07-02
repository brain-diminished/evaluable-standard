<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Basic implementation of a generic ternary operator, based on PHP native operator(s) (only one until now).
 */
class TernaryOperator implements Evaluable
{
    /** @var string */
    protected $operator;

    /** @var Evaluable */
    protected $lhs;

    /** @var Evaluable */
    protected $hs;

    /** @var Evaluable */
    protected $rhs;

    public function __construct(string $operator, Evaluable $lhs, Evaluable $hs, Evaluable $rhs)
    {
        $this->lhs = $lhs;
        $this->hs = $hs;
        $this->rhs = $rhs;
        $this->operator = $operator;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        switch ($this->operator) {
            case '?': return $this->lhs->evaluate($context) ? $this->hs->evaluate($context) : $this->rhs->evaluate($context);
            default:
                throw new \RuntimeException("Ternary operator $this->operator could not be resolved");
        }
    }
}
