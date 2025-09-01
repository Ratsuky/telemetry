# telemetry

## Installation

Install the latest version with:

```bash
$ composer require ratsuky/telemetry
```

## Usage

### Basic Usage

Create a new instance of the Telemetry class providing the driver and the needed options for each driver.

```php
<?php

include 'vendor/autoload.php';

use Ratsuky\Telemetry\Telemetry;

$currentDir = __DIR__;
// Print to stdout
$l_stdout = new Telemetry('stdout');
$l_stdout->info('test');
$l_stdout->debug('test_debug');

// Print to text file
$l_text = new Telemetry('text', ['file_path' => $currentDir . DIRECTORY_SEPARATOR.'telemetry.log']);
$l_text->info('test');
$l_text->debug('test_debug');

// Print to json file
$l_text = new Telemetry('json', ['file_path' => $currentDir . DIRECTORY_SEPARATOR.'telemetry.json']);
$l_text->info('test');
$l_text->debug('test_debug');

```

### Alternative usage
Create a blank instance and set the driver you want to use prior to using any of the loging function
```php
<?php

include 'vendor/autoload.php';

use Ratsuky\Telemetry\Telemetry;

$currentDir = __DIR__;
// Print to stdout
$l_stdout = new Telemetry();
$l_stdout->setDriver('stdout');
$l_stdout->info('test');
$l_stdout->debug('test_debug');

// Print to text file
$l_text = new Telemetry();
$l_text->setDriver('text', ['file_path' => $currentDir . DIRECTORY_SEPARATOR.'telemetry.log']);
$l_text->info('test');
$l_text->debug('test_debug');

// Print to json file
$l_text = new Telemetry();
$l_text->('json', ['file_path' => $currentDir . DIRECTORY_SEPARATOR.'telemetry.json']);
$l_text->info('test');
$l_text->debug('test_debug');

```
### Drivers

For usage of any of the **drivers options are mandatory**  
Missing any property will result in an **exception**

Available drivers are 

**stdout**  
Write out to the running instance of the script
- options : none 


**text**  
writes out to a provided text file
- options : file_path

**json**  
Writes out to a json file
- options : file_path