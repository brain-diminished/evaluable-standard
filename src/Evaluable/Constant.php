<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Implementation of a constant, non-typed, value, which is not affected by the runtime context.
 * Note that it may store pretty much anything you want.
 */
class Constant implements Evaluable
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        return $this->value;
    }
}
