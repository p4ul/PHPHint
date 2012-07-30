<?php

namespace PHPHint\Tools\Metrics;

use PHPHint\TestCase;
use Symfony\Component\Process\Process;

abstract class MetricsTool
{
    protected $report;

    public function run($command)
    {
        $process = new Process($command);
        $process->setTimeout(180);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $this->report = $process->getOutput();
    }

    public function getReport()
    {
        return $this->report;
    }
    
    public function setReport($report)
    {
        $this->report = $report;
        return $this;
    }
}