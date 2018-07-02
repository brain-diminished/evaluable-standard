<?php
namespace BrainDiminished\Evaluable\Standard\Descriptor;

use BrainDiminished\Evaluable\Compiler\Context\PrefixOperatorDescriptor;
use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\Standard\Arity\OperatorFixedArity;
use BrainDiminished\Evaluable\Standard\Evaluable\UnaryOperator;

class UnaryPrefixOperatorDescriptor extends PrefixOperatorDescriptor
{
    /** @var string */
    private $symbol;

    public function __construct(string $symbol, int $priority)
    {
        parent::__construct(new OperatorFixedArity(1, $priority));
        $this->symbol = $symbol;
    }

    public function instantiate(array $args): Evaluable
    {
        return new UnaryOperator($this->symbol, reset($args));
    }
}
