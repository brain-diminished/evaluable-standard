<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * This evaluable needs two parameters, themselves evaluable. Note that indexed access is supposed to be available on
 * value returned from $array. This is not our responsibility to check types. For now.
 */
class ArrayAccess implements Evaluable
{
    /** @var Evaluable */
    private $array;

    /** @var Evaluable */
    private $index;

    public function __construct(Evaluable $array, Evaluable $index)
    {
        $this->array = $array;
        $this->index = $index;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        $array = $this->array->evaluate($context);
        $index = $this->index->evaluate($context);
        return $array[$index];
    }
}
