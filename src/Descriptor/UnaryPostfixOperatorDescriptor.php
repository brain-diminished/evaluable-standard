<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\InfixOperatorDescriptor;
use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\Standard\Arity\OperatorFixedArity;

class UnaryPostfixOperatorDescriptor extends InfixOperatorDescriptor
{
    /** @var string */
    private $symbol;

    public function __construct(string $symbol, int $priority)
    {
        parent::__construct(new OperatorFixedArity(0, -1, $priority));
        $this->symbol = $symbol;
    }

    public function instantiate(Evaluable $lhs, array $rhs): Evaluable
    {
        return new \BrainDiminished\Evaluable\Standard\Evaluable\UnaryOperator($this->symbol, $lhs);
    }
}
