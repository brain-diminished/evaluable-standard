<?php
namespace BrainDiminished\Evaluable\Standard\RuntimeContext;

use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Very simple implementation of interface RuntimeContext.
 */
class StandardRuntimeContext implements RuntimeContext
{
    protected $dictionary = [];

    public function getIdentifier(string $identifier)
    {
        if (key_exists($identifier, $this->dictionary)) {
            return $this->dictionary[$identifier];
        } else {
            throw new \OutOfRangeException("Identifier `$identifier` does not exist.");
        }
    }

    public function register(string $identifier, $value)
    {
        if (key_exists($identifier, $this->dictionary)) {
            throw new \InvalidArgumentException(".dentifier `$identifier` is already declared.");
        }
        $this->dictionary[$identifier] = $value;
    }
}
