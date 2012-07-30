<?php

namespace PHPHint\Tools\Analysis;

use PHPHint\TestCase;

class PHPMD extends AnalysisTool
{
    public function __construct(TestCase $testcase)
    {
        $this->run('phpmd ' . $testcase->getFilepath() . ' xml codesize,design,unusedcode,naming');
    }
}