<?php
namespace Commandii\Tests;

use \Commandii\StatusMessages;
use \Commandii\AnsiColors;

class StatusMessagesTest extends \PHPUnit_Framework_TestCase
{
  public $verbosePointer = false;



  public function testDotNonVerbose()
  {
    // Set the verbose pointer
    StatusMessages::setVerbosePointer($this->verbosePointer);
    AnsiColors::enableColors();

    // Set the verbose to false
    $this->verbosePointer = false;

    // Test if the function returns a ! in red
    $this->expectOutputString("\033[1;31m!\033[0m");
    StatusMessages::dot(StatusMessages::TYPE_ERROR, '!', 'ERROR');
  }

  public function testDotVerbose()
  {
    // Set the verbose pointer
    StatusMessages::setVerbosePointer($this->verbosePointer);
    AnsiColors::enableColors();

    // Set the verbose to true
    $this->verbosePointer = true;

    // Test if the function returns the text ERROR in red
    $this->expectOutputString("\033[1;31mERROR\033[0m\n");
    StatusMessages::dot(StatusMessages::TYPE_ERROR, '!', 'ERROR');
  }

  public function testSetVerbosePointer()
  {
    StatusMessages::setVerbosePointer($this->verbosePointer);

    $this->verbosePointer = true;
    $this->assertEquals(true, StatusMessages::$verbosePointer);

    $this->verbosePointer = false;
    $this->assertEquals(false, StatusMessages::$verbosePointer);
  }

  public function testResetVerbosePointer()
  {
    StatusMessages::setVerbosePointer($this->verbosePointer);

    $this->verbosePointer = true;
    $this->assertEquals(true, StatusMessages::$verbosePointer);

    StatusMessages::resetVerbosePointer();

    $this->assertEquals(null, StatusMessages::$verbosePointer);
  }

  public function testVerboseMessageWithoutVerbosePointer()
  {
    // Disable the colors for this test
    AnsiColors::disableColors();

    // Reset the verbosepointer
    StatusMessages::resetVerbosePointer();

    $this->expectOutputString('TEST');
    StatusMessages::message('TEST', false, true);
  }

  public function testVerboseMessageWithVerbosePointerInVerboseMode()
  {
    // Disable the colors for this test
    AnsiColors::disableColors();

    // Set the verbosepointer
    StatusMessages::setVerbosePointer($this->verbosePointer);
    $this->verbosePointer = true;

    $this->expectOutputString('TEST');
    StatusMessages::message('TEST', false, true);
  }

  public function testVerboseMessageWithVerbosePointerInNonVerboseMode()
  {
    // Disable the colors for this test
    AnsiColors::disableColors();

    // Set the verbosepointer
    StatusMessages::setVerbosePointer($this->verbosePointer);
    $this->verbosePointer = false;

    $this->expectOutputString('');
    StatusMessages::message('TEST', false, true);
  }

  public function testUnknownColor()
  {
    $colors = StatusMessages::$colors;

    StatusMessages::$colors = [StatusMessages::TYPE_DEFAULT => 'white'];

    $this->assertEquals('<white>', StatusMessages::color(StatusMessages::TYPE_SUCCESS));

    StatusMessages::$colors = $colors;
  }

  public function testNullColor()
  {
    $this->assertEquals('<white>', StatusMessages::color());
  }

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

  public function testInfoTextWithoutColors()
  {
    AnsiColors::disableColors();
    $this->expectOutputString("INFOTEXT\n");
    StatusMessages::infoText('INFOTEXT');
  }

  public function testInfoTextWithDefaultColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[1;37mINFOTEXT\033[0m\n");
    StatusMessages::infoText('INFOTEXT');
  }

  public function testInfoTextWithAlternateColors()
  {
    AnsiColors::enableColors();
    $this->expectOutputString("\033[1;36mINFOTEXT\033[0m\n");
    StatusMessages::infoText('INFOTEXT', StatusMessages::TYPE_NOTICE);
  }
}
