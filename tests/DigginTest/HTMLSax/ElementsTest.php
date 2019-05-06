<?php
namespace DigginTest\HTMLSax;

use PHPUnit\Framework\TestCase;

class ElementsTest extends TestCase
{
    use BasicSetupTrait;

    function testEmptyElement()
    {
        $this->listener->expects($this->once())
            ->method('startHandler')->with($this->parser, 'tag', [], false);
        $this->listener->expects($this->once())
            ->method('endHandler')->with($this->parser, 'tag', false);
        $this->listener->expects($this->never())
            ->method('dataHandler');

        $this->parser->parse('<tag></tag>');
    }

    function testElementWithContent()
    {

        $this->listener->expects($this->once())
            ->method('startHandler')->with($this->parser, 'tag', [], false);
        $this->listener->expects($this->once())
            ->method('dataHandler')->with($this->parser, 'stuff');
        $this->listener->expects($this->once())
            ->method('endHandler')->with($this->parser, 'tag', false);
        $this->parser->parse('<tag>stuff</tag>');
    }
    function testMismatchedElements()
    {
        // $this->listener->expectArgumentsAt(0, 'startHandler', array('*', 'b', array(),FALSE));
        // $this->listener->expectArgumentsAt(1, 'startHandler', array('*', 'i', array(),FALSE));
        // $this->listener->expectArgumentsAt(0, 'endHandler', array('*', 'b',FALSE));
        // $this->listener->expectArgumentsAt(1, 'endHandler', array('*', 'i',FALSE));

        $this->listener->expects($this->exactly(2))->method('startHandler');
        $this->listener->expects($this->exactly(2))->method('endHandler');
        $this->parser->parse('<b><i>stuff</b></i>');
    }
    function testCaseFolding()
    {

        $this->listener->expects($this->once())
            ->method('startHandler')->with($this->parser, 'TAG', [], false);
        $this->listener->expects($this->once())
            ->method('dataHandler')->with($this->parser, 'stuff');
        $this->listener->expects($this->once())
            ->method('endHandler')->with($this->parser, 'TAG', false);
        $this->parser->set_option('XML_OPTION_CASE_FOLDING');
        $this->parser->parse('<tag>stuff</tag>');
    }
    function testEmptyTag()
    {

        $this->listener->expects($this->once())
            ->method('startHandler')->with($this->parser, 'tag', [], true);
        $this->listener->expects($this->never())
            ->method('dataHandler');
        $this->listener->expects($this->once())
            ->method('endHandler')->with($this->parser, 'tag', true);

        $this->parser->parse('<tag />');
    }
    function testAttributes()
    {

        $this->listener->expects($this->once())
            ->method('startHandler')
            ->with($this->parser, 'tag', ["a" => "A", "b" => "B", "c" => "C"], false);
        $this->parser->parse('<tag a="A" b=\'B\' c = "C">');
    }

    function testEmptyAttributes()
    {

        $this->listener->expects($this->once())
            ->method('startHandler')
            ->with($this->parser, 'tag', ["a" => null, "b" => null, "c" => null], false);

        $this->parser->parse('<tag a b c>');
    }
    function testNastyAttributes()
    {

        $this->listener->expects($this->once())
            ->method('startHandler')
            ->with($this->parser, 'tag', ["a" => "&%$'?<>", "b" => "\r\n\t\"", "c" => ""], false);

        $this->parser->parse("<tag a=\"&%$'?<>\" b='\r\n\t\"' c = ''>");
    }
    function testAttributesPadding()
    {

        $this->listener->expects($this->once())
            ->method('startHandler')
            ->with($this->parser, 'tag', ["a" => "A", "b" => "B", "c" => "C"], false);

        $this->parser->parse("<tag\ta=\"A\"\rb='B'\nc = \"C\"\n>");
    }
}
