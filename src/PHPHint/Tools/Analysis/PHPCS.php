<?php

namespace PHPHint\Tools\Analysis;

use PHPHint\TestCase;

class PHPCS extends AnalysisTool
{
    public function __construct(TestCase $testcase)
    {
        $this->run('phpcs --report=checkstyle --standard=PSR2 ' . $testcase->getFilepath());
    }

    public function getResults()
    {
        if ($this->getStatus()) {
            return null;
        }

        $xml = new \SimpleXMLElement($this->getOutput());
        
        foreach ($xml->file->error as $error) {
            $item['line'] = (string) $error['line'];
            $item['column'] = (string) $error['column'];
            $item['message'] = (string) $error['message'];
            $errors[] = $item;
        }

        return $errors;
    }
}