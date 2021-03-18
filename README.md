# complex_numbers

Класс выполняющий базовые операции с комплексными числами
***

```
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

```

**Результатом будет:**

```
part1: 5 + 3i
part2: 2 + i
________________
Sum: 7 + 4i
Sub: 3 + 2i
Mul: 7 + 11i
Div 2.6 + 0.2i
```

### Тестирование:
* В каталоге test лежит скрипт-тест, использующий PHPUnit для тестирования.
* Предполагается наличие каталога PHPUnit в директории выше, относительно скрипта класса ComplexNumbers.php
* Если необходимо скорректировать путь к PHPUnit каталогу, то следует поправить путь в скрипте автолоадера: **autoloader.php**, в конце файла:
```
$autoloader = new NamespaceAutoloader();
// $autoloader->addNamespace('PHPUnit', __DIR__ . '/../PHPUnit/phpunit');
$autoloader->addNamespace('PHPUnit', __DIR__ . 'Путь к каталогу');
$autoloader->register();
```