<?php
namespace Sc\ComplexBase;

use Sc\ComplexBase\Exceptions\ComplexDivisionByZeroException;

/**
 * Implements complex numbers base math methods
 * Immutable
 */
class Complex
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
    
    /**
     * @return float Real number part
     */
    public function getReal(): float
    {
        return $this->real;
    }
    
    /**
     * @return float Imaginary number part
     */
    public function getImaginary(): float
    {
        return $this->im;
    }
    
    public function __toString(): string
    {
        return $this->real . ($this->im >= 0 ? '+' : '') . $this->im . 'i';
    }
    
    /** 
     * Negates the number parts
     * @return static Negated number
     */
    public function negative()
    {
        return new static(-$this->real, -$this->im);
    }
    
    /**
     * Adds two numbers
     * @param Complex $b second argument
     * @return static Add result
     */
    public function add(Complex $b)
    {
        return new static($this->real + $b->real, $this->im + $b->im);
    }
    
    /**
     * Subs $b from this number
     * @param Complex $b second argument
     * @return static Sub result
     */
    public function sub(Complex $b)
    {
        return new static($this->real - $b->real, $this->im - $b->im);
    }
    
    /**
     * Multiplies this number by $b
     * @param Complex $b second argument
     * @return static Mul result
     */
    public function mul(Complex $b)
    {
        $r = ($this->real * $b->real) - ($this->im * $b->im);
        $i = ($this->real * $b->im) + ($b->real * $this->im);
        return new static($r, $i);
    }
    
    /**
     * Divides this number by $b
     * @param Complex $b second argument
     * @return static Div result
     * @throws ComplexDivisionByZeroException when division by zero
     */
    public function div(Complex $b)
    {
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
}
