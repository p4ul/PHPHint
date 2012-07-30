<?php

namespace PHPHint\Tools\Metrics;

use PHPHint\TestCase;

class PHPLoc extends MetricsTool
{
    public function __construct(TestCase $testcase)
    {
        $this->run('phploc ' . $testcase->getFilepath());
    }

    public function getResults()
    {
        $data = explode("\n", $this->getReport());

        foreach ($data as $item) {
            if ($item == '') {
                continue;
            }

            if (strpos($item, 'phploc') !== false) {
                continue;
            }

            $item = trim($item);
            $item = explode(':', $item);
            $results[trim($item[0])] = trim($item[1]);
        }

        return $results;
    }
}