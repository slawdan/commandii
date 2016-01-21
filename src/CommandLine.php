<?php
namespace Commandii;

class CommandLine
{
  public static $totalArguments = 0;
  public static $totalParameters = 0;
  public static $arguments = [];



  public static function parseArgs($argv = null)
  {
    $output = array();

    $argv = $argv ? $argv : $_SERVER['argv'];
    array_shift($argv);

    for ($loop = 0, $totalArguments = count($argv); $loop < $totalArguments; $loop++) {
      $argument = $argv[$loop];

      if (substr($argument, 0, 2) == '--') {
        $eq = strpos($argument, '=');

        if ($eq !== false) {
          $output[substr($argument, 2, $eq - 2)] = substr($argument, $eq + 1);
        } else {
          $parameter = substr($argument, 2);

          if ($loop + 1 < $totalArguments && $argv[$loop + 1][0] !== '-') {
            $output[$parameter] = $argv[$loop + 1];
            $loop++;
          } elseif (!isset($output[$parameter])) {
            $output[$parameter] = true;

            self::$totalParameters++;
          }
        }
      } elseif (substr($argument, 0, 1) == '-') {
        if (substr($argument, 2, 1) == '=') {
          $output[substr($argument, 1, 1)] = substr($argument, 3);
        } else {
          foreach (str_split(substr($argument, 1)) as $parameter) {
            if (!isset($output[$parameter])) {
              $output[$parameter] = true;
            }
          }

          if ($loop + 1 < $totalArguments && $argv[$loop + 1][0] !== '-') {
            $output[$parameter] = $argv[$loop + 1];
            $loop++;
          }
        }
      } else {
        $output[] = $argument;
      }
    }

    self::$totalArguments = $totalArguments;

    static::$arguments = $output;

    return $output;
  }
}
