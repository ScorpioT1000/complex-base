<?php
namespace ScorpioT1000\ComplexBase\Form;

use ScorpioT1000\ComplexBase\ComplexInterface;
use ScorpioT1000\ComplexBase\Exceptions\ComplexDivisionByZeroException;

/**
 * Implements base math methods of complex numbers in rectangular form (algebraic notation)
 * Immutable
 */
class Complex implements ComplexInterface
{
    /** @var float */
    protected $real;
    
    /** @var float */
    protected $im;
    
    /**
     * @param float $real Real number part
     * @param float $imaginary Imaginary number part
     */
    public function __construct(float $real, float $imaginary)
    {
        $this->real = $real;
        $this->im = $imaginary;
    }
    
    public function getReal(): float
    {
        return $this->real;
    }
    
    public function getImaginary(): float
    {
        return $this->im;
    }

    public function toRectangular(): Complex
    {
        return $this;
    }

    public function toTrigonometric(): ComplexTrigonometric
    {
        return new ComplexTrigonometric($this->getMagnitude(), $this->getAngle());
    }
    
    public function __toString(): string
    {
        return $this->real . ($this->im >= 0 ? '+' : '') . $this->im . 'i';
    }
    
    public function negative(): ComplexInterface
    {
        return new static(-$this->real, -$this->im);
    }
    
    public function add(ComplexInterface $b): ComplexInterface
    {
        $b = $b->toRectangular();
        return new static($this->real + $b->real, $this->im + $b->im);
    }
    
    public function sub(ComplexInterface $b): ComplexInterface
    {
        $b = $b->toRectangular();
        return new static($this->real - $b->real, $this->im - $b->im);
    }
    
    public function mul(ComplexInterface $b): ComplexInterface
    {
        $b = $b->toRectangular();
        $r = ($this->real * $b->real) - ($this->im * $b->im);
        $i = ($this->real * $b->im) + ($b->real * $this->im);
        return new static($r, $i);
    }
    
    public function div(ComplexInterface $b): ComplexInterface
    {
        $b = $b->toRectangular();
        $r1 = $this->real; 
        $i1 = $this->im;
        $r2 = $b->real; 
        $i2 = $b->im;
        
        $div = $r2*$r2 + $i2*$i2;
        
        if ($div == 0.0) {
            throw new ComplexDivisionByZeroException('Division by zero: a = '.$this.', b = '.$b);
        }
        
        $r = ($r1*$r2 + $i1*$i2) / $div;
        $i = ($i1*$r2 - $r1*$i2) / $div;
        
        return new static($r, $i);
    }

    public function getAngle(): float
    {
        return atan2($this->im, $this->real);
    }

    public function getMagnitude(): float
    {
        return sqrt(($this->real * $this->real) + ($this->im * $this->im));
    }
}