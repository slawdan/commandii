<?php
namespace Commandii;

use Commandii\AnsiColors;

class StatusMessages
{
  /**
   * Show a success
   */
  public static function success($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . '<green>DONE', true));
  }

  /**
   * Show a warning
   */
  public static function warning($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . '<darkYellow>FAILURE', true));
  }

  /**
   * Show an error
   */
  public static function error($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . '<red>ERROR', true));
  }

  /**
   * Show a skipped message
   */
  public static function skipped($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . '<cyan>SKIPPED', true));
  }

  /**
   * Show a warning text
   */
  public static function warningText($message)
  {
    self::output(AnsiColors::colorize('<darkYellow>' . $message, true));
  }

  /**
   * Show an error text
   */
  public static function errorText($message)
  {
    self::output(AnsiColors::colorize('<red>' . $message, true));
  }

  /**
   * Show a message
   */
  public static function message($message, $linefeed = true)
  {
    self::output(AnsiColors::Colorize($message, $linefeed));
  }

  /**
   * Show a newline
   */
  public static function newLine()
  {
    self::output("\n");
  }

  /**
   * Output the message
   * This function can be stubbed for tests
   */
  public static function output($message)
  {
    echo $message;
  }
}
