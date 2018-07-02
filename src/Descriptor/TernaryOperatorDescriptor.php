<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\InfixOperatorDescriptor;
use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\Standard\Arity\OperatorFixedArity;
use BrainDiminished\Evaluable\Standard\Evaluable\TernaryOperator;

class TernaryOperatorDescriptor extends InfixOperatorDescriptor
{
    /** @var string */
    private $symbol;

    public function __construct(string $symbol1, string $symbol2, int $priority, bool $isLeftAssociative = true)
    {
        parent::__construct(new OperatorFixedArity(2, $priority, $priority - $isLeftAssociative ? 1 : 0, $symbol2));
        $this->symbol = $symbol1;
    }

    public function instantiate(Evaluable $lhs, array $rhs): Evaluable
    {
        return new TernaryOperator($this->symbol, $lhs, $rhs[0], $rhs[1]);
    }
}
