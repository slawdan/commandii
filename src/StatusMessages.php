<?php
namespace Commandii;

use Commandii\AnsiColors;

class StatusMessages
{
  const TYPE_DEFAULT = 0;
  const TYPE_SUCCESS = 1;
  const TYPE_WARNING = 2;
  const TYPE_ERROR   = 3;
  const TYPE_SKIPPED = 4;
  const TYPE_DRYRUN  = 5;
  const TYPE_NOTICE  = 6;
  const TYPE_INFO    = 7;

  public static $colors = [];

  public static $verbosePointer = null;



  /**
   * Init the colors
   */
  public static function initColors()
  {
    static::$colors = [
      static::TYPE_DEFAULT => 'white',
      static::TYPE_SUCCESS => 'green',
      static::TYPE_WARNING => 'darkYellow',
      static::TYPE_ERROR   => 'red',
      static::TYPE_SKIPPED => 'cyan',
      static::TYPE_DRYRUN  => 'blue',
      static::TYPE_NOTICE  => 'cyan',
      static::TYPE_INFO    => 'white'
    ];
  }

  /**
   * Return the requested color for the given type
   * @param $type
   */
  public static function color($type = null)
  {
    // Check if the colors are set
    if (sizeof(static::$colors) == 0) {
      // Set the colors
      static::initColors();
    }

    // Check if the type was given
    if ($type !== null) {
      // Check if the type exists
      if (!isset(static::$colors[$type])) {
        $type = static::TYPE_DEFAULT;
      }
    } else {
      $type = static::TYPE_DEFAULT;
    }

    $color = '<' . static::$colors[$type] . '>';

    return $color;
  }

  /**
   * Set a pointer to a variable that holds the verbose value
   * @param $pointer
   */
  public static function setVerbosePointer(&$pointer)
  {
    static::$verbosePointer = &$pointer;
  }

  /**
   * Reset the verbosepointer
   */
  public static function resetVerbosePointer()
  {
    static::$verbosePointer = null;
  }

  /**
   * Show a success
   * @param $spacer
   */
  public static function success($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . static::color(static::TYPE_SUCCESS) . 'DONE', true));
  }

  /**
   * Show a warning
   * @param $spacer
   */
  public static function warning($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . static::color(static::TYPE_WARNING) . 'FAILURE', true));
  }

  /**
   * Show an error
   * @param $spacer
   */
  public static function error($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . static::color(static::TYPE_ERROR) . 'ERROR', true));
  }

  /**
   * Show a skipped message
   * @param $spacer
   */
  public static function skipped($spacer = false)
  {
    self::output(AnsiColors::colorize(($spacer ? ' ' : '') . static::color(static::TYPE_SKIPPED) . 'SKIPPED', true));
  }

  /**
   * Show a warning text
   * @param $message
   */
  public static function warningText($message)
  {
    self::output(AnsiColors::colorize(static::color(static::TYPE_WARNING) . $message, true));
  }

  /**
   * Show an error text
   * @param $message
   */
  public static function errorText($message)
  {
    self::output(AnsiColors::colorize(static::color(static::TYPE_ERROR) . $message, true));
  }

  /**
   * Show an info text
   */
  public static function infoText($message, $type = null)
  {
    // If the type isn't set we set it with the INFO type
    if ($type == null) {
      $type = static::TYPE_INFO;
    }

    self::output(AnsiColors::colorize(static::color($type) . $message, true));
  }

  /**
   * Show a message
   * @param $message
   * @param $linefeed
   * @param $verboseOnly
   */
  public static function message($message, $linefeed = true, $verboseOnly = false)
  {
    if ($verboseOnly) {
      // Check if the verbosePointer points to a true false
      if (static::$verbosePointer === false) {
        // Verbose is off so we don't show this message
        return false;
      }
    }

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
   * Show a dot
   * @param $type
   * @param $character
   * @param $verbosemessage
   */
  public static function dot($type, $character = '.', $verboseMessage = '')
  {
    $color = static::color($type);

    if (static::$verbosePointer) {
      self::output(AnsiColors::colorize($color . $verboseMessage, true));
    } else {
      self::output(AnsiColors::colorize($color . $character));
    }
  }

  /**
   * Show a question and wait for user input
   * @param  $question
   * @param  $timeout
   *
   * @return boolean
   */
  public static function question($question, $timeout = 5)
  {
    // Show the question
    static::message($question . ' (y/N) ', false);

    $fd = fopen('php://stdin', 'r');

    $read = [$fd];
    $write = [];
    $except = [];

    // Wait 5 seconds for input
    if (stream_select($read, $write, $except, $timeout)) {
      $answer = substr(strtolower(fgets($fd)), 0, 1);
      if ($answer == 'y') {
        return true;
      }
    }

    return false;
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
