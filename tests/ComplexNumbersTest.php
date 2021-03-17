<?php

declare(strict_types=1);

namespace tests;

require_once __DIR__ . '/../autoloader.php';
require_once __DIR__ . '/../ComplexNumbers.php';

use ComplexNumbers;
use PHPUnit\Framework\TestCase;


class ExternalMicroservicesTest extends TestCase
{
  private ComplexNumbers $CN1;
  private ComplexNumbers $CN2;
  private ComplexNumbers $CN3;
  private ComplexNumbers $CN4;
  private ComplexNumbers $CN5;
  private ComplexNumbers $CN6;
  private ComplexNumbers $CN7;
  private ComplexNumbers $CN8;
  private ComplexNumbers $CN9;

  protected function setUp(): void
  {
    parent::setUp();
    $this->CN1 = new ComplexNumbers();
    $this->CN1->setNumberOne(5, 3);// 5 + 3i
    $this->CN1->setNumberTwo(2, 1);// 2 + i
    $this->CN2 = new ComplexNumbers();
    $this->CN2->setNumberOne(5, -3);// 5 - 3i
    $this->CN2->setNumberTwo(2, 1);// 2 + i
    $this->CN3 = new ComplexNumbers();
    $this->CN3->setNumberOne(5, 3);// 5 + 3i
    $this->CN3->setNumberTwo(2, -1);// 2 - i
    $this->CN4 = new ComplexNumbers();
    $this->CN4->setNumberOne(5, -3);// 5 - 3i
    $this->CN4->setNumberTwo(2, -1);// 2 - i
    $this->CN5 = new ComplexNumbers();
    $this->CN5->setNumberOne(-5, -3);// -5 - 3i
    $this->CN5->setNumberTwo(2, -1);// 2 - i
    $this->CN6 = new ComplexNumbers();
    $this->CN6->setNumberOne(-5, -3);// -5 - 3i
    $this->CN6->setNumberTwo(2, 3);// 2 + 3i
    $this->CN7 = new ComplexNumbers();
    $this->CN7->setNumberOne(-5, -3);// -5 - 3i
    $this->CN7->setNumberTwo(2, 4);// 2 + 4i
    $this->CN8 = new ComplexNumbers();
    $this->CN8->setNumberOne(-5, -4);// -5 - 4i
    $this->CN8->setNumberTwo(2, 3);// 2 + 3i
    $this->CN9 = new ComplexNumbers();
    $this->CN9->setNumberOne(-5, -4);// -5 - 4i
    $this->CN9->setNumberTwo(5, 3);// 5 + 3i
  }

  public function testSum()
  {
    $this->assertTrue($this->CN1->sumAsString() == '7 + 4i');
    $this->assertTrue($this->CN2->sumAsString() == '7 - 2i');
    $this->assertTrue($this->CN3->sumAsString() == '7 + 2i');
    $this->assertTrue($this->CN4->sumAsString() == '7 - 4i');
    $this->assertTrue($this->CN5->sumAsString() == '-3 - 4i');
    $this->assertTrue($this->CN6->sumAsString() == '-3');
    $this->assertTrue($this->CN7->sumAsString() == '-3 + i');
    $this->assertTrue($this->CN8->sumAsString() == '-3 - i');
    $this->assertTrue($this->CN9->sumAsString() == '-i');
  }

  public function testSub()
  {
    $this->assertTrue($this->CN1->subAsString() == '3 + 2i');
    $this->assertTrue($this->CN2->subAsString() == '3 - 4i');
    $this->assertTrue($this->CN3->subAsString() == '3 + 4i');
    $this->assertTrue($this->CN4->subAsString() == '3 - 2i');
    $this->assertTrue($this->CN5->subAsString() == '-7 - 2i');
    $this->assertTrue($this->CN6->subAsString() == '-7 - 6i');
    $this->assertTrue($this->CN7->subAsString() == '-7 - 7i');
    $this->assertTrue($this->CN8->subAsString() == '-7 - 7i');
  }

  public function testMul()
  {
    $this->assertTrue($this->CN1->mulAsString() == '7 + 11i');
    $this->assertTrue($this->CN2->mulAsString() == '13 - i');
    $this->assertTrue($this->CN3->mulAsString() == '13 + i');
    $this->assertTrue($this->CN4->mulAsString() == '7 - 11i');
  }

  public function testDiv()
  {
    $this->assertTrue($this->CN1->divAsString() == '2.6 + 0.2i');
    $this->assertTrue($this->CN2->divAsString() == '1.4 - 2.2i');
    $this->assertTrue($this->CN3->divAsString() == '1.4 + 2.2i');
    $this->assertTrue($this->CN4->divAsString() == '2.6 - 0.2i');
  }
}
