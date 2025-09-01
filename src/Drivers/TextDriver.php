<?php
namespace Ratsuky\Telemetry\Drivers;

use Carbon\Carbon;

class TextDriver
{
    private $formattedMessage = '';

    private $filePath = '';

    public function __construct($options = [])
    {
        if(!empty($options)){
            if(isset($options['file_path'])){
                $this->filePath = trim($options['file_path']);
                $this->ensureLogFileExists();
                if(!is_writable($this->filePath)){
                    throw new \RuntimeException("The specified log file path is not writable; provided path : " . $filePath);
                }
            }
        } else {
            throw new \RuntimeException("The 'file_path' option must be provided for TextDriver.");
        }
    }

    public function processMessage($message, $level)
    {
        $moment = Carbon::now()->toDateTimeString();
        $this->formattedMessage = "[" . $moment . "] [" . $level . "] " . $message . "\n";
        return $this;
    }

    public function write(): void
    {
        file_put_contents($this->filePath, $this->formattedMessage, FILE_APPEND);
    }

    private function ensureLogFileExists(): void
    {
        if (!file_exists($this->filePath)) {
            $handle = fopen($this->filePath, 'w');
            if ($handle === false) {
                throw new \RuntimeException("Failed to create log file at: " . $this->filePath);
            }
            fclose($handle);
        }
    }

}