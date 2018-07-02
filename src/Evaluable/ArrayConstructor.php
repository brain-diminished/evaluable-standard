<?php
namespace BrainDiminished\Evaluable\Standard\Evaluable;

use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\RuntimeContext;

/**
 * Given a set of sub-evaluable objects, this class will aggregate them into an array().
 */
class ArrayConstructor implements Evaluable
{
    /** @var Evaluable[] */
    private $elements;

    /** @var bool */
    private $acceptKeys;

    /**
     * @param Evaluable[] $elements
     * @param bool $acceptKeys
     */
    public function __construct(array $elements, bool $acceptKeys = true)
    {
        $this->elements = $elements;
        $this->acceptKeys = $acceptKeys;
    }

    public function evaluate(RuntimeContext $context = null)
    {
        $array = [];
        foreach ($this->elements as $element) {
            $entry = $element->evaluate($context);
            if ($this->acceptKeys && is_array($entry) && count($entry) === 2) {
                $array[$entry[0]] = $entry[1];
            } else {
                $array[] = $entry;
            }

        }
        return $array;
    }
}
