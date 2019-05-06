<?php
namespace DigginTest\HTMLSax;

/**
 * @package Diggin
 * @version $Id: xml_htmlsax_test.php,v 1.3 2004/05/28 11:53:48 hfuecks Exp $
 */
interface ListenerInterface
{
    function startHandler($parser, $name, $attrs);
    function endHandler($parser, $name);
    function dataHandler($parser, $data);
    function piHandler($parser, $target, $data);
    function escapeHandler($parser, $data);
    function jaspHandler($parser, $data);
}
