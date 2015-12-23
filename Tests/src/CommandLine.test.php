<?php
namespace Commandii\Tests;

use \Commandii\CommandLine;

class CommandLineTest extends \PHPUnit_Framework_TestCase
{
  public function testNoArgs()
  {
    // Simulate a call without arguments
    $args = array(0 => 'binfile');

    $this->assertEquals(0, sizeof(CommandLine::parseArgs($args)));
  }

  public function testOneArgument()
  {
    // Simulate a call with 1 argument
    $args = array(0 => 'binfile', 1 => 'argument');

    $this->assertEquals(1, sizeof(CommandLine::parseArgs($args)));
  }

  public function testOneArgumentAndOneParameter()
  {
    // Simulate a call with 1 argument and 1 parameter
    $args = array(0 => 'binfile', 1 => 'argument', 2 => '--parameter');

    $this->assertEquals(2, sizeof(CommandLine::parseArgs($args)));
  }

  public function testOneArgumentAndOneParameterWithValue()
  {
    // Simulate a call with 1 argument and 1 parameter
    $args = array(0 => 'binfile', 1 => 'argument', 2 => '--parameter', 3 => 'test');

    $this->assertEquals(2, sizeof(CommandLine::parseArgs($args)));
  }

  public function testOneArgumentAndOneParameterWithEqualCharacter()
  {
    // Simulate a call with 1 argument and 1 parameter
    $args = array(0 => 'binfile', 1 => 'argument', 2 => '--parameter=value');

    $this->assertEquals(2, sizeof(CommandLine::parseArgs($args)));
  }

  public function testOneArgumentAndOneParameterWithEqualCharacterAlt1()
  {
    // Simulate a call with 1 argument and 1 parameter
    $args = array(0 => 'binfile', 1 => 'argument', 2 => '-p', 3 => '-v=2');

    $this->assertEquals(3, sizeof(CommandLine::parseArgs($args)));
  }

  public function testOneArgumentAndOneParameterWithEqualCharacterAlt2()
  {
    // Simulate a call with 1 argument and 1 parameter
    $args = array(0 => 'binfile', 1 => '-a', 2 => 'value', 3 => '-v=2');

    $this->assertEquals(2, sizeof(CommandLine::parseArgs($args)));
  }

  public function testOneArgumentAndOneParameterWithEqualCharacterAltAndArgumentLast()
  {
    // Simulate a call with 1 argument and 1 parameter
    $args = array(0 => 'binfile', 1 => 'argument', 2 => '-p', 3 => '-v=2', 4 => 'argument2');

    $this->assertEquals(4, sizeof(CommandLine::parseArgs($args)));
  }
}
