#Commandii
Commandii exists of 3 components: commandline, ansicolors and statusmessages.

##Commandline
To use the commandline component in your code you need to include 'use Commandii\Commandline'.
To retrieve the used commandline commands and arguments: 'CommandLine::parseArgs($args)'
This will return an array with all of the values, example:
- application command --argument1=value --argument2
Will return:
- [0] => command
- [argument1] => value
- [argument2] => 1

If there is no value for the argument it will automatically be filled with a 1.

##StatusMessages
The StatusMessages component exists of the following functions:
###setVerbosePointer($verbosePointer)
###resetVerbosePointer()
###dot($type, $character, $verboseMessage)
###success($spacer)
###warning($spacer)
###error($spacer)
###skipped($spacer)
###warningText($message)
###errorText($message)
###infoText($message, $type)
###message($message, $linefeed, $verboseOnly)
###newLine()

##AnsiColors
To enable colors (default: on) you can call the function enableColors. To disable you can call disableColors.
These functions can be used without any params. If you want the manually colorize a string you can use
the colorize function. This function has 2 params: (String) textstring, (Bool) linebreak
