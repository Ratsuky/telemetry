<?php

namespace Ratsuky\Telemetry;

use Psr\Log\LogLevel;
use RuntimeException;
use Psr\Log\AbstractLogger;
use Ratsuky\Telemetry\Drivers\TextDriver;
use Ratsuky\Telemetry\Drivers\JsonDriver;

class Telemetry extends AbstractLogger
{
    private $driver = null;

    private $supportedDrivers = ['stdout', 'text', 'json'];

    private $driverMappings = [
        'stdout' => Drivers\StdOutDriver::class,
        'text'   => Drivers\TextDriver::class,
        'json'   => Drivers\JsonDriver::class,
    ];

    private $storeBacktrace = false;

    protected $logLevels = array(
        LogLevel::EMERGENCY => 0,
        LogLevel::ALERT     => 1,
        LogLevel::CRITICAL  => 2,
        LogLevel::ERROR     => 3,
        LogLevel::WARNING   => 4,
        LogLevel::NOTICE    => 5,
        LogLevel::INFO      => 6,
        LogLevel::DEBUG     => 7
    );

    public function __construct($driver = null, $driverOptions = [], $storeBacktrace = false)
    {
        if (!is_null($driver)) {
            $this->setDriver($driver, $driverOptions);
        }
    }

    public function addDriver($name, $class): void
    {
        if (!in_array($name, $this->supportedDrivers)) {
            $this->supportedDrivers[] = $name;
            $this->driverMappings[$name] = $class;
        } else {
            throw new RuntimeException("Driver already exists. Use a different name.");
        }
    }

    public function setDriver(string $driver = 'text', $options = []): void
    {
        if (!in_array($driver, $this->supportedDrivers)) {
            throw new RuntimeException("Invalid driver specified. Allowed drivers are: " . implode(', ', $supportedDrivers));
        }
        $this->driver =  $this->driverMappings[$driver] ? new $this->driverMappings[$driver]($options) : null;
    }

    public function log($level, string|\Stringable $message, array $context = []): void{
        //$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $logLevelText = strtoupper($level);

        if(!is_null($this->driver)){
            $this->driver->processMessage($message, $logLevelText)->write();
        } else {
            throw new RuntimeException("No logging driver has been set. Please set a driver before logging messages.");
        }
    }
}