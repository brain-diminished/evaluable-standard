<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\PrefixOperatorDescriptor;
use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\Standard\Arity\OperatorFixedArity;

class IdentityDescriptor extends PrefixOperatorDescriptor
{
    public function __construct(string $delimiter = ')')
    {
        parent::__construct(new OperatorFixedArity(1, 0, 0, null, $delimiter));
    }

    public function instantiate(array $args): Evaluable
    {
        return $args[0];
    }
}