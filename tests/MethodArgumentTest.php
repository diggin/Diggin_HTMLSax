<?php
namespace DigginTest\HTMLSax;

use InvalidArgumentException;
use Diggin\HTMLSax\HTMLSax;
use PHPUnit\Framework\TestCase;

class MethodArgumentTest extends TestCase
{
    public function testSetObjectMethod()
    {
        $this->expectException(InvalidArgumentException::class);
        $parser = new HTMLSax();
        $parser->set_object('string');
    }

    public function testSetOptionMethod()
    {
        $this->expectException(InvalidArgumentException::class);
        $parser = new HTMLSax();
        $parser->set_option('unexpected option name ', false);
    }
}
