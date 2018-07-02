<?php
namespace BrainDiminished\Evaluable\Standard\Context;

use BrainDiminished\Evaluable\Compiler\Context\CompilationContext;
use BrainDiminished\Evaluable\Compiler\Context\InfixOperatorDescriptor;
use BrainDiminished\Evaluable\Compiler\Context\PrefixOperatorDescriptor;
use BrainDiminished\Evaluable\Compiler\Exception\CompilationException;
use BrainDiminished\Evaluable\Evaluable;
use BrainDiminished\Evaluable\Standard\Descriptor\ArrayAccessDescriptor;
use BrainDiminished\Evaluable\Standard\Descriptor\ArrayConstructorDescriptor;
use BrainDiminished\Evaluable\Standard\Descriptor\BinaryOperatorDescriptor;
use BrainDiminished\Evaluable\Standard\Descriptor\FunctionCallDescriptor;
use BrainDiminished\Evaluable\Standard\Descriptor\IdentityDescriptor;
use BrainDiminished\Evaluable\Standard\Descriptor\TernaryOperatorDescriptor;
use BrainDiminished\Evaluable\Standard\Descriptor\UnaryPrefixOperatorDescriptor;
use BrainDiminished\Evaluable\Standard\Evaluable\Constant;
use BrainDiminished\Evaluable\Standard\Evaluable\Variable;

class DefaultCompilationContext implements CompilationContext
{
    private $prefixOperators = [];
    private $infixOperators = [];

    public function __construct()
    {
        $this->prefixOperators['!'] = new UnaryPrefixOperatorDescriptor('!', 3);
        $this->prefixOperators['~'] = new UnaryPrefixOperatorDescriptor('~', 3);
        $this->prefixOperators['+'] = new UnaryPrefixOperatorDescriptor('+', 3);
        $this->prefixOperators['-'] = new UnaryPrefixOperatorDescriptor('-', 3);
        $this->prefixOperators['('] = new IdentityDescriptor();
        $this->prefixOperators['['] = new ArrayConstructorDescriptor();
        $this->infixOperators['&&'] = new BinaryOperatorDescriptor('&&', 12, true);
        $this->infixOperators['||'] = new BinaryOperatorDescriptor('||', 14, true);
        $this->infixOperators['&']  = new BinaryOperatorDescriptor('&', 9, true);
        $this->infixOperators['|']  = new BinaryOperatorDescriptor('|', 11, true);
        $this->infixOperators['^']  = new BinaryOperatorDescriptor('^', 10, true);
        $this->infixOperators['<<'] = new BinaryOperatorDescriptor('<<', 6, true);
        $this->infixOperators['>>'] = new BinaryOperatorDescriptor('>>', 6, true);
        $this->infixOperators['>='] = new BinaryOperatorDescriptor('>=', 7, true);
        $this->infixOperators['>']  = new BinaryOperatorDescriptor('>', 7, true);
        $this->infixOperators['<='] = new BinaryOperatorDescriptor('<=', 7, true);
        $this->infixOperators['<']  = new BinaryOperatorDescriptor('<', 7, true);
        $this->infixOperators['=']  = new BinaryOperatorDescriptor('=', 8, true);
        $this->infixOperators['<>'] = new BinaryOperatorDescriptor('<>', 8, true);
        $this->infixOperators['!='] = new BinaryOperatorDescriptor('!=', 8, true);
        $this->infixOperators['**'] = new BinaryOperatorDescriptor('**', 3, false);
        $this->infixOperators['*']  = new BinaryOperatorDescriptor('*', 4, true);
        $this->infixOperators['/']  = new BinaryOperatorDescriptor('/', 4, true);
        $this->infixOperators['%']  = new BinaryOperatorDescriptor('%', 4, true);
        $this->infixOperators['+']  = new BinaryOperatorDescriptor('+', 5, true);
        $this->infixOperators['-']  = new BinaryOperatorDescriptor('-', 5, true);
        $this->infixOperators['.']  = new BinaryOperatorDescriptor('.', 5, true);
        $this->infixOperators['??']  = new BinaryOperatorDescriptor('??', 15, true);
        $this->infixOperators['?']  = new TernaryOperatorDescriptor('?', ':', 15, false);
        $this->infixOperators['(']  = new FunctionCallDescriptor();
        $this->infixOperators['[']  = new ArrayAccessDescriptor();
    }

    public function getSafetyChar(): string
    {
        return '@';
    }

    public function getAtomPattern(): string
    {
        return '[^\W\d]\w*|\d+(\.\d*)?|(\d*\.)\d+|true\b|false\b|null\b|\'[^\']*\'|"[^"]*"';
    }

    public function buildAtom(string $symbol): Evaluable
    {
        switch (true) {
            case $symbol == 'true':
                return new Constant(true);
            case $symbol == 'false':
                return new Constant(false);
            case $symbol == 'null':
                return new Constant(null);
            case ctype_digit($symbol):
                return new Constant(intval($symbol));
            case is_numeric($symbol):
                return new Constant(floatval($symbol));
            case preg_match('/^\'[^\']*\'|"[^"]*"$/', $symbol):
                return new Constant(substr($symbol, 1, strlen($symbol) - 2));
            case preg_match('/^[^\W\d]\w*$/', $symbol):
                return new Variable($symbol);
            default:
                throw new CompilationException("Cannot resolve constant `$symbol`", 0);
        }
    }

    public function getPrefixOperatorPattern(): string
    {
        return implode('|', array_map('preg_quote', array_keys($this->prefixOperators)));
    }

    public function getPrefixOperatorDescriptor(string $symbol): PrefixOperatorDescriptor
    {
        return $this->prefixOperators[$symbol];
    }

    public function getInfixOperatorPattern(): string
    {
        return implode('|', array_map('preg_quote', array_keys($this->infixOperators)));
    }

    public function getInfixOperatorDescriptor(string $symbol): InfixOperatorDescriptor
    {
        return $this->infixOperators[$symbol];
    }
}
