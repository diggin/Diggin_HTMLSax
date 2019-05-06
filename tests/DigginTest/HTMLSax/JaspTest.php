<?php

namespace DigginTest\HTMLSax;

use PHPUnit\Framework\TestCase;

class JaspTest extends TestCase
{
    use BasicSetupTrait;

    function testSimple()
    {
        $this->listener->expects($this->once())->method(
            'jaspHandler',
            ['*', ' document.write("Hello World");']
        );
        // $this->listener->expectNever('piHandler');
        // $this->listener->expectNever('escapeHandler');
        // $this->listener->expectNever('dataHandler');
        // $this->listener->expectNever('startHandler');
        // $this->listener->expectNever('endHandler');
        $this->parser->parse('<' . '% document.write("Hello World");%>');
    }
    function testNasty()
    {
        $this->listener->expects($this->once())->method(
            'jaspHandler',
            ['*', ' <tag a="A"><?php ?></tag><!-- comment --> ']
        );
        // $this->listener->expectNever('piHandler');
        // $this->listener->expectNever('escapeHandler');
        // $this->listener->expectNever('dataHandler');
        // $this->listener->expectNever('startHandler');
        // $this->listener->expectNever('endHandler');
        $this->parser->parse('<' . '% <tag a="A"><?php ?></tag><!-- comment --> %>');
    }
    function testInTag()
    {
        $this->listener->expects($this->once())->method(
            'jaspHandler',
            ['*', ' document.write("Hello World");']
        );
        // $this->listener->expectNever('piHandler');
        // $this->listener->expectNever('escapeHandler');
        // $this->listener->expectNever('dataHandler');
        $this->listener->expects($this->once())->method('startHandler');
        $this->listener->expects($this->once())->method('endHandler');
        $this->parser->parse('<tag><' . '% document.write("Hello World");%></tag>');
    }
}
