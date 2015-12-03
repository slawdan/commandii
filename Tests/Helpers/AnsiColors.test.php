<?php
namespace Commandii\Tests;

use \Commandii\AnsiColors;

class AnsiColorsTest extends \PHPUnit_Framework_TestCase
{
  public function testEnableColors()
  {
    AnsiColors::EnableColors();
    $this->assertEquals(true, AnsiColors::$enabled);
  }

  public function testDisableColors()
  {
    AnsiColors::DisableColors();
    $this->assertEquals(false, AnsiColors::$enabled);
  }
}
