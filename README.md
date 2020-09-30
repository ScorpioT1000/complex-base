# complex-base
Complex numbers base operations

**Usage:**

```php
    $a = new Complex(4, 4);
    $b = new Comples(2, 2);
    
    echo 'a = '. $a . PHP_EOL;
    echo 'b = '. $b . PHP_EOL;
    
    echo '-a = '.$a->negative() . PHP_EOL;
    echo 'a + b = '.$a->add($b) . PHP_EOL;
    echo 'a - b = '.$a->sub($b) . PHP_EOL;
    echo 'a * b = '.$a->mul($b) . PHP_EOL;
    echo 'a / b = '.$a->div($b) . PHP_EOL;
```