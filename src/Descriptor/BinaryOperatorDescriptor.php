<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\InfixOperatorDescriptor;
use BrainDiminished\Evaluable\Standard\Arity\OperatorFixedArity;
use BrainDiminished\Evaluable\Standard\Evaluable\BinaryOperator;
use BrainDiminished\Evaluable\Evaluable;

class BinaryOperatorDescriptor extends InfixOperatorDescriptor
{
    /** @var string */
    private $symbol;

    public function __construct(string $symbol, int $priority, bool $isLeftAssociative = true)
    {
        parent::__construct(new OperatorFixedArity(1, $priority, $priority - ($isLeftAssociative ? 1 : 0)));
        $this->symbol = $symbol;
    }

    public function instantiate(Evaluable $lhs, array $rhs): Evaluable
    {
        return new BinaryOperator($this->symbol, $lhs, reset($rhs));
    }
}
