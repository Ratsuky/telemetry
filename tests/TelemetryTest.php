<?php
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Ratsuky\Telemetry\Telemetry;

final class TelemetryTest extends TestCase
{
    public function testStdOutDriver(): void
    {
        $l_stdout = new Telemetry('stdout');
        $l_stdout->info('test');
        $l_stdout->debug('test_debug');

        $this->assertTrue(true);
    }

    public function testTextDriver(): void
    {

        $l_text = new Telemetry('text', ['file_path' => __DIR__ . DIRECTORY_SEPARATOR.'telemetry.log']);
        $l_text->info('test');
        $l_text->debug('test_debug');

        $this->assertTrue(true);
    }

    public function testJsonDriver(): void
    {
        $l_text = new Telemetry('json', ['file_path' => __DIR__ . DIRECTORY_SEPARATOR.'telemetry.json']);
        $l_text->info('test');
        $l_text->debug('test_debug');

        $this->assertTrue(true);
    }
}