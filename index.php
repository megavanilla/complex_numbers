<?php
declare(strict_types=1);

require_once __DIR__ . '/ComplexNumbers.php';

$CN = new ComplexNumbers();
$CN->setNumberOne(5, 3);
$CN->setNumberTwo(2, 1);
print($CN);
print('<hr />');
print("\n<br />Sum: {$CN->sumAsString()}");
print("\n<br />Sub: {$CN->subAsString()}");
print("\n<br />Mul: {$CN->mulAsString()}");
print("\n<br />Div {$CN->divAsString()}");