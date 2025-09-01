<?php
namespace Ratsuky\Telemetry\Drivers;

use Carbon\Carbon;

class StdOutDriver 
{
    private $formattedMessage='';

    public function __construct($options = []){}

    public function processMessage($message, $level){
        $moment = Carbon::now()->toDateTimeString();
        $this->formattedMessage = "[" . $moment . "] [" . $level . "] " . $message . "\n";
        return $this;
    }

    public function write(): void
    {
        fwrite(STDOUT, $this->formattedMessage);
    }
}