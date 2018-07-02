<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\PrefixOperatorDescriptor;
use BrainDiminished\Evaluable\Standard\Arity\OperatorMultipleArity;
use BrainDiminished\Evaluable\Standard\Evaluable\ArrayConstructor;
use BrainDiminished\Evaluable\Evaluable;

class ArrayConstructorDescriptor extends PrefixOperatorDescriptor
{
    public function __construct(string $separator = ',', string $delimiter = ']')
    {
        parent::__construct(new OperatorMultipleArity($separator, $delimiter));
    }

    public function instantiate(array $args): Evaluable
    {
        return new ArrayConstructor($args);
    }
}
