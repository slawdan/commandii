<?php
namespace Commandii;

class AnsiColors
{
  public static $enabled = true;
  public static $tags = array(
    // Foreground colors
    '<black>'       => "\033[0;30m",
    '<red>'         => "\033[1;31m",
    '<green>'       => "\033[1;32m",
    '<yellow>'      => "\033[1;33m",
    '<blue>'        => "\033[1;34m",
    '<magenta>'     => "\033[1;35m",
    '<cyan>'        => "\033[1;36m",
    '<white>'       => "\033[1;37m",
    '<gray>'        => "\033[0;37m",
    '<darkRed>'     => "\033[0;31m",
    '<darkGreen>'   => "\033[0;32m",
    '<darkYellow>'  => "\033[0;33m",
    '<darkBlue>'    => "\033[0;34m",
    '<darkMagenta>' => "\033[0;35m",
    '<darkCyan>'    => "\033[0;36m",
    '<darkWhite>'   => "\033[0;37m",
    '<darkGray>'    => "\033[1;30m",

    // Background colors
    '<bgBlack>'     => "\033[40m",
    '<bgRed>'       => "\033[41m",
    '<bgGreen>'     => "\033[42m",
    '<bgYellow>'    => "\033[43m",
    '<bgBlue>'      => "\033[44m",
    '<bgMagenta>'   => "\033[45m",
    '<bgCyan>'      => "\033[46m",
    '<bgWhite>'     => "\033[47m",

    // Texteffects
    '<bold>'        => "\033[1m",
    '<italics>'     => "\033[3m",

    // General reset
    '<reset>'       => "\033[0m",
  );



  public static function colorize($input, $linebreak = false)
  {
    if (!static::$enabled) {
      return str_replace(array_keys(static::$tags), '', $input) . ($linebreak ? "\n" : '');
    }

    $input .= '<reset>';
    return str_replace(array_keys(static::$tags), static::$tags, $input) . ($linebreak ? "\n" : '');
  }

  public static function enableColors()
  {
    static::$enabled = true;
  }

  public static function disableColors()
  {
    static::$enabled = false;
  }
}
