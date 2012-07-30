<?php

namespace PHPHint\Tools\Analysis;

use PHPHint\TestCase;
use Symfony\Component\Process\Process;

abstract class AnalysisTool
{
    protected $errors;
    protected $output;
    protected $status = true;

    public function run($command)
    {
        $process = new Process($command);
        $process->setTimeout(180);
        $process->run();
        $this->setOutput($process->getOutput());

        if (!$process->isSuccessful()) {
            $this->setErrors($process->getErrorOutput());
            $this->setStatus(false);
            return;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
    
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }

    public function getOutput()
    {
        return $this->output;
    }
    
    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}