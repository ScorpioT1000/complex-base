<?php
namespace ScorpioT1000\ComplexBase;

use ScorpioT1000\ComplexBase\Exceptions\ComplexDivisionByZeroException;
use ScorpioT1000\ComplexBase\Form\ComplexTrigonometric;
use ScorpioT1000\ComplexBase\Form\Complex;

/**
 * Complex number representation interface.
 * Immutable
 */
interface ComplexInterface
{    
    /**
     * Returns real part of the rectangular (algebraic) form
     * 
     * @return float Real number part
     */
    public function getReal(): float;

    /**
     * Returns imaginary part of the rectangular (algebraic) form
     * 
     * @return float Imaginary number part
     */
    public function getImaginary(): float;

    /**
     * Returns magnitude part of the trigonometric (polar) form
     * 
     * @return float Magnitude part
     */
    public function getMagnitude(): float;

    /**
     * Returns direction part of the trigonometric (polar) form
     * 
     * @return float Direction part (angle in radians)
     */
    public function getAngle(): float;

    /**
     * Converts (or casts) current form to rectangular.
     * Returns current object if no conversion applied.
     *
     * @return Complex
     */
    public function toRectangular(): Complex;

    /**
     * Converts (or casts) current form to trigonometric.
     * Returns current object if no conversion applied.
     * 
     * @return ComplexTrigonometric
     */
    public function toTrigonometric(): ComplexTrigonometric;

    /** 
     * Negates the number parts
     * @return ComplexInterface Negated number
     */
    public function negative(): ComplexInterface;

    /**
     * Adds two numbers
     * @param ComplexInterface $b second argument
     * @return ComplexInterface Add result
     */
    public function add(ComplexInterface $b): ComplexInterface;

    /**
     * Subs $b from this number
     * @param ComplexInterface $b second argument
     * @return ComplexInterface Sub result
     */
    public function sub(ComplexInterface $b): ComplexInterface;

    /**
     * Multiplies this number by $b
     * @param ComplexInterface $b second argument
     * @return ComplexInterface Mul result
     */
    public function mul(ComplexInterface $b): ComplexInterface;

    /**
     * Divides this number by $b
     * @param ComplexInterface $b second argument
     * @return ComplexInterface Div result
     * @throws ComplexDivisionByZeroException when division by zero
     */
    public function div(ComplexInterface $b): ComplexInterface;
    
    public function __toString(): string;
}
