<?php
namespace BrainDiminished\Test\Evaluable\Standard;

use BrainDiminished\Evaluable\Compiler\Stream\CompilationStream;
use BrainDiminished\Evaluable\Compiler\Token\Token;
use BrainDiminished\Evaluable\Standard\Context\DefaultCompilationContext;
use PHPUnit\Framework\TestCase;

class ExpressionStreamTest extends TestCase
{
    public function testStream()
    {
        $expression = '8 cos - [+ ? ()';
        $stream = new CompilationStream($expression, new DefaultCompilationContext);
        $stream->next(Token::ATOM);
        $stream->next(Token::ATOM);
        $stream->next(Token::PREFIX_OPERATOR);
        $stream->next(Token::PREFIX_OPERATOR);
        $stream->next(Token::INFIX_OPERATOR);
        $stream->next(Token::INFIX_OPERATOR);
        $stream->next(Token::INFIX_OPERATOR);
        $stream->next(Token::DELIMITER, ')');
    }
}
