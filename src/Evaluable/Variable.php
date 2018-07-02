<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

class Variable implements Evaluable
{
    /** @var string */
    private $identifier;

    public function __construct(string $name)
    {
        $this->identifier = $name;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        if ($context === null) {
            throw new \RuntimeException("Impossible to solve `$this->identifier` without a runtime context.");
        }
        return $context->getIdentifier($this->identifier);
    }
}
