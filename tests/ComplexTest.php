<?php
namespace ScorpioT1000\ComplexBase\Tests;

use ScorpioT1000\ComplexBase\Form\Complex;
use ScorpioT1000\ComplexBase\Exceptions\ComplexDivisionByZeroException;
use PHPUnit\Framework\TestCase;

final class ComplexTest extends TestCase
{
    public function testInstantiation()
    {
        $c11 = new Complex(1.0, 1.0);
        $this->assertSame($c11->getReal(), 1.0);
        $this->assertSame($c11->getImaginary(), 1.0);        
    }
    
    public function testArithmetic()
    {
        $c11 = new Complex(1.0, 1.0);
        
        $cn11 = $c11->negative();
        $this->assertSame($cn11->getReal(), -1.0);
        $this->assertSame($cn11->getImaginary(), -1.0);
        
        $c22 = new Complex(2.0, 2.0);
        $c33 = $c11->add($c22);
        $this->assertSame($c33->getReal(), 3.0);
        $this->assertSame($c33->getImaginary(), 3.0);
        
        $c11 = $c22->sub($c11);
        $this->assertSame($c11->getReal(), 1.0);
        $this->assertSame($c11->getImaginary(), 1.0);
        
        $c04 = $c11->mul($c22);
        $this->assertSame($c04->getReal(), 0.0);
        $this->assertSame($c04->getImaginary(), 4.0);
        
        $c48 = new Complex(4.0, 8.0);
        $c31 = $c48->div($c22);
        $this->assertSame($c31->getReal(), 3.0);
        $this->assertSame($c31->getImaginary(), 1.0);
        
        $caughtDivByZero = false;
        try {
            $c11->div(new Complex(0.0, 0.0));
        } catch(ComplexDivisionByZeroException $e) {
            $caughtDivByZero = true;
        }
        $this->assertSame($caughtDivByZero, true);
    }
}
