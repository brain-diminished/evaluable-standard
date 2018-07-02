<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\InfixOperatorDescriptor;
use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\Standard\Arity\OperatorFixedArity;
use BrainDiminished\Evaluable\Standard\Evaluable\ArrayAccess;

class ArrayAccessDescriptor extends InfixOperatorDescriptor
{
    public function __construct(string $separator = ',', string $delimiter = ']')
    {
        parent::__construct(new OperatorFixedArity(1, 0, 0, null, $delimiter));
    }

    /**
     * @param Evaluable $lhs
     * @param Evaluable[] $rhs
     * @return Evaluable
     */
    public function instantiate(Evaluable $lhs, array $rhs): Evaluable
    {
        return new ArrayAccess($lhs, $rhs[0]);
    }
}