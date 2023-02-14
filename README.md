## Installation

```
composer require kzorluoglu/chameleon-bash:dev-main
```

Add Bundle under registerBundles() in the app/AppKernel.php

```php
    public function registerBundles()
    {
        $bundles = array(
            ..
            ...
            ...
            new \kzorluoglu\ChameleonBash\kzorluogluChameleonBashBundle(),

```


### Basic Usage
A runtime developer console, interactive debugger for Chameleon System 7.1.x

```
[kzorluoglu@devbox customer (⎈ |default:default)]$ app/console chameleon_system:shell

Psy Shell v0.11.12 (PHP 7.4.33 — cli) by Justin Hileman
Chameleon System Shell v0.1.1 Hello
> help
  help       Show a list of commands. Type `help [foo]` for information about [foo].      Aliases: ?                     
  ls         List local, instance or class variables, methods and constants.              Aliases: dir                   
  dump       Dump an object or primitive.                                                                                
  doc        Read the documentation for an object, class, constant, method or property.   Aliases: rtfm, man             
  show       Show the code for an object, class, constant, method or property.                                           
  wtf        Show the backtrace of the most recent exception.                             Aliases: last-exception, wtf?  
  whereami   Show where you are in the code.                                                                             
  throw-up   Throw an exception or error out of the Psy Shell.                                                           
  timeit     Profiles with a timer.                                                                                      
  trace      Show the current call stack.                                                                                
  buffer     Show (or clear) the contents of the code input buffer.                       Aliases: buf                   
  clear      Clear the Psy Shell screen.                                                                                 
  edit       Open an external editor. Afterwards, get produced code in input buffer.                                     
  sudo       Evaluate PHP code, bypassing visibility restrictions.                                                       
  history    Show the Psy Shell history.                                                  Aliases: hist                  
  exit       End the current session and return to caller.                                Aliases: quit, q   
...
...
```


ToDo:
