<?php
namespace ScorpioT1000\ComplexBase\Tests;

use PHPUnit\Framework\TestCase;
use ScorpioT1000\ComplexBase\Form\Complex;
use ScorpioT1000\ComplexBase\Form\ComplexTrigonometric;
use ScorpioT1000\ComplexBase\Exceptions\ComplexDivisionByZeroException;

final class ComplexTrigonometricTest extends TestCase
{
    public function testInstantiation()
    {
        $c11 = new ComplexTrigonometric(1.0, 1.0);
        $this->assertSame($c11->getMagnitude(), 1.0);
        $this->assertSame($c11->getAngle(), 1.0); 

        $c1pi7 = new ComplexTrigonometric(1.0, M_PI*7);
        $this->assertSame($c1pi7->getAngle(), M_PI); 

        $c1mpi = new ComplexTrigonometric(1.0, -M_PI); // angle normalization
        $this->assertSame($c1mpi->getAngle(), M_PI); 
    }

    public function testConversion()
    {
        $t = new ComplexTrigonometric(1.0, 1.0);
        $r = $t->toRectangular()->toTrigonometric();
        $this->assertEquals($t->getMagnitude(), $r->getMagnitude(), '', 0.000000001); 
        $this->assertEquals($t->getAngle(), $r->getAngle(), '', 0.000000001);

        $t = new ComplexTrigonometric(1.0, -1.0);
        $r = $t->toRectangular()->toTrigonometric();
        $this->assertEquals($t->getMagnitude(), $r->getMagnitude(), '', 0.000000001); 
        $this->assertEquals($t->getAngle(), $r->getAngle(), '', 0.000000001);

        $t = new ComplexTrigonometric(-500.0, 6.0);
        $r = $t->toRectangular()->toTrigonometric();
        $this->assertEquals($t->getMagnitude(), $r->getMagnitude(), '', 0.000000001); 
        $this->assertEquals($t->getAngle(), $r->getAngle(), '', 0.000000001);

        // cross-conversion per component
        $r1 = new Complex(1.0, 1.0);
        $r2 = $r1->toRectangular();
        $this->assertEquals($r1->getMagnitude(), $r2->getMagnitude(), '', 0.000000001); 
        $this->assertEquals($r1->getAngle(), $r2->getAngle(), '', 0.000000001);
        $this->assertEquals($r1->getReal(), $r2->getReal(), '', 0.000000001); 
        $this->assertEquals($r1->getImaginary(), $r2->getImaginary(), '', 0.000000001);
    }
    
    public function testArithmetic()
    {
        $c1pi = new ComplexTrigonometric(1, M_PI);
        $c2pi = new ComplexTrigonometric(2, M_PI);

        $r = $c1pi->negative();
        $this->assertEquals($r->getMagnitude(), 1); 
        $this->assertEquals($r->getAngle(), 0, '', 0.000000001);

        $r = $c1pi->add($c2pi);
        $this->assertEquals($r->getMagnitude(), 3); 
        $this->assertEquals($r->getAngle(), M_PI, '', 0.000000001);

        $r = $c1pi->sub($c2pi);
        $this->assertEquals($r->getMagnitude(), 1); 
        $this->assertEquals($r->getAngle(), 0, '', 0.000000001);

        $r = $c2pi->mul(new ComplexTrigonometric(2, M_PI));
        $this->assertEquals($r->getMagnitude(), 4); 
        $this->assertEquals($r->getAngle(), 0, '', 0.000000001);
        
        $r = $c2pi->div(new ComplexTrigonometric(2, M_PI_2));
        $this->assertEquals($r->getMagnitude(), 1); 
        $this->assertEquals($r->getAngle(), M_PI_2, '', 0.000000001);

        $divByZero = false;
        try {
            $c2pi->div(new ComplexTrigonometric(0,0));
        } catch(ComplexDivisionByZeroException $e) {
            $divByZero = true;
        }
        $this->assertSame($divByZero, true); 
    }
}
