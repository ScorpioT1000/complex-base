# complex-base
Complex numbers base operations

Installation
====

```
    composer require sc/complex-base 0.*
```

Usage
====

```php
    use Sc\ComplexBase\Complex;
    
    ...

    $a = new Complex(4, 4);
    $b = new Complex(2, 2);
    
    echo 'a = '. $a . PHP_EOL;
    echo 'b = '. $b . PHP_EOL;
    
    echo '-a = '.$a->negative() . PHP_EOL;
    echo 'a + b = '.$a->add($b) . PHP_EOL;
    echo 'a - b = '.$a->sub($b) . PHP_EOL;
    echo 'a * b = '.$a->mul($b) . PHP_EOL;
    echo 'a / b = '.$a->div($b) . PHP_EOL;
```

Run tests
====

```
    phpunit ./tests
```