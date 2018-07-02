<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Basic implementation of a generic binary operator, based on PHP native operators.
 */
class BinaryOperator implements Evaluable
{
    /** @var string */
    private $operator;

    /** @var Evaluable */
    protected $lhs;

    /** @var Evaluable */
    protected $rhs;

    public function __construct(string $operator, Evaluable $lhs, Evaluable $rhs)
    {
        $this->operator = $operator;
        $this->lhs = $lhs;
        $this->rhs = $rhs;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        switch ($this->operator) {
            case '+': return $this->lhs->evaluate($context) + $this->rhs->evaluate($context);
            case '-': return $this->lhs->evaluate($context) - $this->rhs->evaluate($context);
            case '*': return $this->lhs->evaluate($context) * $this->rhs->evaluate($context);
            case '/': return $this->lhs->evaluate($context) / $this->rhs->evaluate($context);
            case '%': return $this->lhs->evaluate($context) % $this->rhs->evaluate($context);
            case '**': return $this->lhs->evaluate($context) ** $this->rhs->evaluate($context);
            case '&&': return $this->lhs->evaluate($context) && $this->rhs->evaluate($context);
            case '||': return $this->lhs->evaluate($context) || $this->rhs->evaluate($context);
            case '&': return $this->lhs->evaluate($context) & $this->rhs->evaluate($context);
            case '|': return $this->lhs->evaluate($context) | $this->rhs->evaluate($context);
            case '^': return $this->lhs->evaluate($context) ^ $this->rhs->evaluate($context);
            case '=': return $this->lhs->evaluate($context) == $this->rhs->evaluate($context);
            case '==': return $this->lhs->evaluate($context) === $this->rhs->evaluate($context);
            case '!=': return $this->lhs->evaluate($context) != $this->rhs->evaluate($context);
            case '<>': return $this->lhs->evaluate($context) <> $this->rhs->evaluate($context);
            case '!==': return $this->lhs->evaluate($context) !== $this->rhs->evaluate($context);
            case '>': return $this->lhs->evaluate($context) > $this->rhs->evaluate($context);
            case '>=': return $this->lhs->evaluate($context) >= $this->rhs->evaluate($context);
            case '<': return $this->lhs->evaluate($context) < $this->rhs->evaluate($context);
            case '<=': return $this->lhs->evaluate($context) <= $this->rhs->evaluate($context);
            case '??': return $this->lhs->evaluate($context) ?? $this->rhs->evaluate($context);
            case '.': return $this->lhs->evaluate($context) . $this->rhs->evaluate($context);
            default:
                throw new \RuntimeException("Binary operator `$this->operator` could not be resolved");
        }
    }
}
