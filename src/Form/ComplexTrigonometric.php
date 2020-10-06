<?php
namespace ScorpioT1000\ComplexBase\Form;

use ScorpioT1000\ComplexBase\ComplexInterface;
use ScorpioT1000\ComplexBase\Exceptions\ComplexDivisionByZeroException;

/**
 * Implements base math methods of complex numbers in trigonometric form (polar coordinates)
 * Immutable
 */
class ComplexTrigonometric implements ComplexInterface
{
    /** @var float */
    protected $mag;
    
    /** @var float */
    protected $phi;

    /**
     * Complex numbers as a plane where the real part gives the horizontal coordinate and the imaginary part gives the vertical coordinate.
     * Writing a complex number in trigonometric form is a way of expressing it in terms of magnitude and direction.
     *
     * @param float $magnitude a positive real number or 0
     * @param float $phi the angle in radians
     */
    public function __construct(float $magnitude, float $phi)
    {
        $this->mag = abs($magnitude);
        $this->phi = static::normalizeAngle($phi);
    }

    public function getMagnitude(): float
    {
        return $this->mag;
    }

    public function getAngle(): float
    {
        return $this->phi;
    }

    public function toRectangular(): Complex
    {
        return new Complex($this->getReal(), $this->getImaginary());
    }

    public function toTrigonometric(): ComplexTrigonometric
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->mag . ' (cos ' . $this->phi . ' + i sin ' . $this->phi . ')';
    }

    public function negative(): ComplexInterface
    {
        return new static(
            $this->mag, 
            $this->phi > 0 ? ($this->phi - M_PI) : ($this->phi + M_PI)
        );
    }
    
    public function add(ComplexInterface $b): ComplexInterface
    {
        $b = $b->toTrigonometric();

        $sinDelta = sin($b->phi - $this->phi);
        $cosDelta = cos($b->phi - $this->phi);
        $mag = sqrt(
            ($this->mag * $this->mag)
            + ($b->mag * $b->mag)
            + 2 * $this->mag * $b->mag * $cosDelta
        );
        $phi = $this->phi + atan2($b->mag * $sinDelta, $this->mag + $b->mag * $cosDelta);

        return new static($mag, $phi);
    }
    
    public function sub(ComplexInterface $b): ComplexInterface
    {
        return $this->add($b->negative());
    }
    
    public function mul(ComplexInterface $b): ComplexInterface
    {
        $b = $b->toTrigonometric();

        return new static($this->mag * $b->mag, $this->phi + $b->phi);
    }
    
    public function div(ComplexInterface $b): ComplexInterface
    {
        $b = $b->toTrigonometric();

        if ($b->mag == 0.0) {
            throw new ComplexDivisionByZeroException('Division by zero: a = '.$this.', b = '.$b);
        }

        return new static($this->mag / $b->mag, $this->phi - $b->phi);
    }

    public function getReal(): float
    {
        return $this->mag * cos($this->phi);
    }

    public function getImaginary(): float
    {
        return $this->mag * sin($this->phi);
    }

    public static function normalizeAngle(float $angle): float
    {
        return $angle - (ceil(($angle + M_PI)/(2.0*M_PI))-1.0)*2.0*M_PI;
    }
}