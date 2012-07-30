<?php

namespace PHPHint\Tools\Analysis;

use PHPHint\TestCase;

class Lint extends AnalysisTool
{
    public function __construct(TestCase $testcase)
    {
        $this->run('php -l ' . $testcase->getFilepath());
    }

    public function getResults()
    {
        if (!$this->getStatus()) {
            return trim($this->getErrors());
        }
    }
}