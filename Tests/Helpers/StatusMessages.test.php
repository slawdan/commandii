<?php
namespace Commandii\Tests;

use \Commandii\StatusMessages;
use \Commandii\AnsiColors;

class StatusMessagesTest extends \PHPUnit_Framework_TestCase
{
  public function testSuccessWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("DONE\n");
    StatusMessages::success();
  }

  public function testSuccessWithColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[1;32mDONE\033[0m\n");
    StatusMessages::success();
  }

  public function testWarningWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("FAILURE\n");
    StatusMessages::warning();
  }

  public function testWarningWithColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[0;33mFAILURE\033[0m\n");
    StatusMessages::warning();
  }

  public function testErrorWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("ERROR\n");
    StatusMessages::error();
  }

  public function testErrorWithColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[1;31mERROR\033[0m\n");
    StatusMessages::error();
  }

  public function testSkippedWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("SKIPPED\n");
    StatusMessages::skipped();
  }

  public function testSkippedWithColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[1;36mSKIPPED\033[0m\n");
    StatusMessages::skipped();
  }

  public function testWarningTextWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("WARNINGTEXT\n");
    StatusMessages::warningText('WARNINGTEXT');
  }

  public function testWarningTextWithColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[0;33mWARNINGTEXT\033[0m\n");
    StatusMessages::warningText('WARNINGTEXT');
  }

  public function testErrorTextWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("ERRORTEXT\n");
    StatusMessages::errorText('ERRORTEXT');
  }

  public function testErrorTextWithColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[1;31mERRORTEXT\033[0m\n");
    StatusMessages::errorText('ERRORTEXT');
  }

  public function testMessageWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("THIS IS A MESSAGE\n");
    StatusMessages::message('THIS IS A MESSAGE');
  }

  public function testMessageWithColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[1;36mTHIS IS A MESSAGE\033[0m\n");
    StatusMessages::message('<cyan>THIS IS A MESSAGE');
  }

  public function testNewLine()
  {
    $this->expectOutputString("\n");
    StatusMessages::newLine();
  }
}
