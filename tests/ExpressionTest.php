<?php

use PHPUnit\Framework\TestCase;
use RegExpressions\Expression;

class ExpressionTest extends TestCase
{

    /** @test */
    public function it_finds_a_string()
    {
        $regex = Expression::make()->find('www');
        
        $this->assertRegExp((string) $regex, 'www');
        
        $regex = Expression::make()->then('google');
        
        $this->assertRegExp((string) $regex, 'google');
    }

    /** @test */
    public function it_checks_for_anything()
    {
        $regex = Expression::make()->anything();

        $this->assertTrue($regex->test('foo'));
    }

    /** @test */
    public function it_maybe_have_a_value()
    {
        $regex = Expression::make()->maybe('http');

        $this->assertTrue($regex->test('http'));
        $this->assertTrue($regex->test(''));
    }

    /** @test */
    public function it_can_chain_method_calls()
    {
        $regex = Expression::make()
            ->find('www')
            ->maybe('.')
            ->then('mixcode');

        $this->assertTrue($regex->test('www.mixcode'));
        $this->assertFalse($regex->test('wwwXmixcode'));
    }

    /** @test */
    public function it_can_exclude_values()
    {
        $regex = Expression::make()
            ->find('foo')
            ->anythingBut('bar')
            ->then('biz');

        $this->assertTrue($regex->test('foobazbiz'));
        $this->assertFalse($regex->test('foobarbiz'));

    }
}