<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Implementation of a function call, the function being itself a sub-evaluable object, along with its parameters.
 */
class FunctionCall implements Evaluable
{
    /** @var Evaluable */
    private $function;

    /** @var Evaluable[] */
    private $args;

    /**
     * @param Evaluable $function
     * @param Evaluable[] $args
     */
    public function __construct(Evaluable $function, array $args = [])
    {
        $this->function = $function;
        $this->args = $args;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        $function = $this->function->evaluate($context);
        if (!is_callable($function)) {
            throw new \RuntimeException("Cannot call non callable: `$function`");
        }
        $args = [];
        foreach ($this->args as $arg) {
            $args[] = $arg->evaluate($context);
        }
        return call_user_func_array($function, $args);
    }
}
