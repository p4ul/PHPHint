<?php

namespace PHPHint\Tools\Fixer;

use PHPHint\TestCase;
use Symfony\Component\Process\Process;

class PHPCSFixer
{
    protected $file;
    protected $report;

    public function __construct(TestCase $testcase)
    {
        $this->run('php-cs-fixer fix ' . $testcase->getFilepath());
        $this->file = $testcase->getFilepath();
    }

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

    public function getResults()
    {
        return file_get_contents($this->file);
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