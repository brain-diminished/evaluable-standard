<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\InfixOperatorDescriptor;
use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\Standard\Arity\OperatorMultipleArity;
use BrainDiminished\Evaluable\Standard\Evaluable\FunctionCall;

class FunctionCallDescriptor extends InfixOperatorDescriptor
{
    public function __construct(string $separator = ',', string $delimiter = ')')
    {
        parent::__construct(new OperatorMultipleArity($separator, $delimiter));
    }

    /**
     * @param Evaluable $lhs
     * @param Evaluable[] $rhs
     * @return Evaluable
     */
    public function instantiate(Evaluable $lhs, array $rhs): Evaluable
    {
        return new FunctionCall($lhs, $rhs);
    }
}