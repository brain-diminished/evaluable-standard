<?php
namespace BrainDiminished\Test\Evaluable\Standard;

use BrainDiminished\Evaluable\Compiler\EvaluableCompiler;
use BrainDiminished\Evaluable\Standard\Context\DefaultCompilationContext;
use BrainDiminished\Evaluable\Standard\RuntimeContext\StandardRuntimeContext;
use PHPUnit\Framework\TestCase;

class ExpressionCompilerTest extends TestCase
{
    protected $context;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $context = new StandardRuntimeContext();
        $context->register('PI', 3.14);
        $context->register('names', ['James', 'Bond']);
        $context->register('truee', 42);
        $context->register('sqr', function ($val) { return $val**2; });
        $context->register('min', function (...$args) { return min($args); });
        $context->register('max', function (...$args) { return max($args); });
        $context->register('cos', function ($arg) { return cos($arg); });
    }


    protected function _testExpression($expected, string $expression)
    {
        $compiler = new EvaluableCompiler(new DefaultCompilationContext());
        $evaluable = $compiler->compile($expression);
        $result = $evaluable->evaluate($this);
        $this->assertEquals($expected, $result);
    }

    public function testConstant()
    {
        $this->_testExpression(3, '3');
    }

    public function testVariable()
    {
        $this->_testExpression(3.14, 'PI');
    }

    public function testAdd()
    {
        $this->_testExpression(3 + 4 + 5, '3 + 4 + 5');
    }

    public function testPriority()
    {
        $this->_testExpression(2 ** 2 + 2, '2 ** 2 + 2');
    }

    public function testMult()
    {
        $this->_testExpression(3 * 4, '3 * 4');
    }

    public function testPow()
    {
        $this->_testExpression(4.**.3, '4.**.3');
    }

    public function testCall()
    {
        $this->_testExpression(25, 'sqr(5)');
    }

    public function testCompose()
    {
        $this->_testExpression((3**2)**2, 'sqr(sqr(3))');
    }

    public function testArray()
    {
        $this->_testExpression([2 , 3], '[2 , 3]');
    }

    public function testArrayAccess()
    {
        $this->_testExpression('Bond', 'names[1]');
    }

    public function testConst()
    {
        $this->_testExpression(true, 'true');
        $this->_testExpression(42, 'truee');
    }

    public function testString()
    {
        $this->_testExpression('foo', '\'foo\'');
        $this->_testExpression('bar', '"bar"');
        $this->_testExpression('baz'[2], '"baz"[2]');
        $this->_testExpression('foo'.'bar', '"foo"."bar"');
    }

    public function testFusionNull()
    {
        $this->_testExpression(null ?? 1 ? 2 : 3, 'null ?? 1 ? 2 : 3');
    }

    public function testTernary()
    {
        $this->_testExpression(1 ? 2 : 3, '1 ? 2 : 3');
    }
}
