<?php
declare(strict_types=1);

/**
 * Требуется написать класс по работе с комплексными числами, реализовать операции сложения,
 * вычитания, умножения и деления, а также провести тестирование его работы.
 * Решение пришлите ссылкой на гит.
 * https://h4e.ru/obshchie-svedeniya/145-primery-reshenij-kompleksnykh-chisel-kalkulyator
 * */
/**
 * https://www.youtube.com/watch?v=xiEFKyjmlfo
 * Комплексное число это число вида: z = x + iy, где x и y это действительные числа, i - это мнимая единица,
 * где i^2 = -1
 * x - действительная часть ReZ(Real Z), а y - ImZ(Imaginary Z) мнимая часть комплексного числа
 * Если x = 0, то z = iy - называется чисто мнимым
 * Если y = 0, то z = x - комплексное числдо содержит в себе действительное число
 * Z = 2 + 3i, сопряжённое этому числу z = 2 - 3i
 * Z = 3 - 5i, сопряжённое этому числу z = 3 + 5i
 * Если комплексное число умножить на сопряжонное ему число,
 * то получим сумму квадратов действительной и мнимой частей:
 * zZ = (x + iy)(x - iy)=x^2 + y^2
 */
/**
 * Действия с комплексными числами
 */
/**
 * Сложение:
 * z1 = x1 + iy1; z2 = x2 + iy2
 * z3 = z1 + z2 = x1 + iy1 + x2 + iy2 = (x1 + x2) + i(y1 + y2)
 */
/**
 * Вычитание:
 * z1 = x1 - iy1; z2 = x2 + iy2
 * z3 = z1 - z2 = (x1 - iy1) - (x2 + iy2) =
 * = x1 - iy1 - x2 - iy2
 * (3 - 4i) - (5 + 2i) = 3 - 4i -5 -2i =
 * = -2 - 6i
 */
/**
 * Произведение:
 * z1 = x1 + iy1; z2 = x2 + iy2
 * z3 = z1 * z2 = (x1 + iy1) * (x2 + iy2)  = x1x1 + ix1y2 + ix2y1 + (i^2)y1y2 =
 * по определению i^2 равен -1, тогда:
 * = (x1x2 - y1y2)+i(x1y2 + x2y1)
 */

/**
 * Деление:
 * z - кеомплексное число,
 * Z - Сопряжённое комплексное число
 * i^2 = -1
 * z1/z2 = (z1*Z2)/(z2*Z2) = ((x1 + iy1)(x2-iy2))/((x2 + iy2)(x2-iy2)) =
 * = (x1x2 - i^2y1y2)+i(x2y1 - x1y2)/ (x2^2 + y2^2) =
 * = (x1x2 + y1y2)+i(x2y1 - x1y2)/ (x2^2 + y2^2)
 */
class ComplexNumbers
{
  private float $a1, $b1, $a2, $b2, $conDenomA2, $conDenomB2 = 0;
  private string $selfClassName;

  public function __construct()
  {
    $this->selfClassName = get_class($this);
  }

  public function __toString(): string
  {
    $part1 = $this->getResultAsString($this->a1, $this->b1);
    $part2 = $this->getResultAsString($this->a2, $this->b2);
    return "part1: $part1\n<br />part2: $part2";
  }

  public function setNumberOne(float $ReZ, float $ImZ)
  {
    $this->a1 = $ReZ;
    $this->b1 = $ImZ;
  }

  public function setNumberTwo(float $ReZ, float $ImZ)
  {
    $this->a2 = $this->conDenomA2 = $ReZ;
    $this->b2 = $ImZ;
    $this->conDenomB2 = (-1) * $ImZ;
  }

  private function getResultAsString(float $a, float $b): string
  {
    $rez = '';
    $imz = '';
    if ($a != 0) {
      $rez = $a;
    }
    if ($b == 1) {
      $imz = (($a != 0) ? ' + ' : '') . 'i';
    } elseif ($b > 0) {
      $imz = (($a != 0) ? ' + ' : '') . "{$b}i";
    } elseif ($b == -1) {
      $imz = (($a != 0) ? ' - ' : '-') . 'i';
    } elseif ($b < 0) {
      $imz = (($a != 0) ? ' - ' . (-1 * $b) : $b) . 'i';
    }
    return $rez . $imz;
  }

  public function sum(): array
  {
    // (a1 + a2) + i(b1 + b2)
    $sumA = $this->a1 + $this->a2;
    $sumB = $this->b1 + $this->b2;

    return [$sumA, $sumB];
  }

  public function sumAsString(): string
  {
    return $this->getResultAsString(...$this->sum());
  }

  public function sub(): array
  {
    // (a1 - a2) + i(b1 - b2)
    $subA = $this->a1 - $this->a2;
    $subB = $this->b1 - $this->b2;

    return [$subA, $subB];
  }

  public function subAsString(): string
  {
    return $this->getResultAsString(...$this->sub());
  }

  public function mul(): array
  {
    // (a1 + b1) * (a2 + b2)
    // (a1 - b1) * (a2 + b2)...
    // a1a2 + a1b2 + b1a2 + b1b2
    /**
     * Знаки между частями ставим, исходя из значения части
     * Предположим: (5 + 3i) * (2 + i), тогда:
     * part1 = a1a2 -> 5*2 -> 10
     * part2 = a1b2 -> 5*i  -> 5i
     * part3 = a2b1 -> 3i*2 -> 6i
     * part4 = b1b2 -> 3i * i -> 3i^2 -> -3, т.к. i2 = -1
     */
    $part1 = $this->a1 * $this->a2;
    $part2 = $this->a1 * $this->b2;
    $part3 = $this->a2 * $this->b1;
    $part4 = $this->b1 * $this->b2;

    $mulA = $part1 + $part4 * (-1);
    $mulB = $part2 + $part3;

    return [$mulA, $mulB];
  }

  public function mulAsString(): string
  {
    return $this->getResultAsString(...$this->mul());
  }

  public function div(): array
  {
    // ((a1a2 + b1b2)/(a2^2 + b2^2)) + i((a2b1 + a1b2)/(a2^2 + b2^2))
    // (a1 + b1) / (a2 + b2)
    // (a1 - b1) / (a2 + b2)...

    /**
     * Согласно доке:
     * При делении комплексных чисел в алгебраической форме необходимо избавиться
     * от мнимой составляющей в знаменателе.
     * Для этого числитель и знаменатель домножают на число,
     * сопряженное знаменателю.
     *
     * Поэтому получим числитель и знаменатель, а затем получим результат деления
     * преобразованных числителя и знаменателя
     */

    /**
     * В целом, стоит использовать собственные методы с передачей параметров,
     * вида: $this->mul($this->a1, $this->b1)...
     * Здесь отображается момент, с поздним связыванием, когда можно получить экземпляр класса,
     * который тут же и описывается.
     */

    $part1Ex = new $this->selfClassName();
    $part1Ex->setNumberOne($this->a1, $this->b1);
    $part1Ex->setNumberTwo($this->conDenomA2, $this->conDenomB2);
    $part1 = $part1Ex->mul();

    $part2Ex = new $this->selfClassName();
    $part2Ex->setNumberOne($this->a2, $this->b2);
    $part2Ex->setNumberTwo($this->conDenomA2, $this->conDenomB2);
    $part2 = $part2Ex->mul();

    $divA = $part1[0] / $part2[0];
    $divB = $part1[1] / $part2[0];

    return [$divA, $divB];
  }

  public function divAsString(): string
  {
    return $this->getResultAsString(...$this->div());
  }
}