<?php

namespace PHPHint\Tools\Analysis;

use PHPHint\TestCase;

class PHPDepend extends AnalysisTool
{
    public function __construct(TestCase $testcase)
    {
        $this->run('pdepend --jdepend-xml=jdepend.xml ' . $testcase->getFilepath());
    }
}