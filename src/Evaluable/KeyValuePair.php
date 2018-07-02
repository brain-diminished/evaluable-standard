<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Given two sub-evaluable objects, return an array(2) composed of these, supposedly to use as a key-value pair.
 */
class KeyValuePair implements Evaluable
{
    /** @var Evaluable */
    private $key;

    /** @var Evaluable */
    private $value;

    public function __construct(Evaluable $key, Evaluable $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        $key = $this->key->evaluate($context);
        $value = $this->value->evaluate($context);
        return [$key, $value];
    }
}
