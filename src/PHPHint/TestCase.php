<?php

namespace PHPHint;

class TestCase
{
    protected $filepath;

    public function __construct($code)
    {
        if (strstr($code, '<?php') === false) {
            throw new \RuntimeException('No PHP code detected! Maybe you forgot to include the opening PHP-Tag "<?php"?');
        }

        $rand = uniqid();
        $this->filepath = "/tmp/phpfile_$rand.php";
        file_put_contents($this->filepath, $code);
    }

    public function __destruct()
    {
        unlink($this->filepath);
    }

    public function getFilepath()
    {
        return $this->filepath;
    }

    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;
    }
}