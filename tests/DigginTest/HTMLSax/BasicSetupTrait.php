<?php
namespace DigginTest\HTMLSax;

use Diggin\HTMLSax\HTMLSax;

trait BasicSetupTrait
{
    protected $parser;
    protected $listener;

    public function setUp()
    {
        $this->listener = $this->getMockBuilder(ListenerInterface::class)->getMock();

        $this->parser = new HTMLSax;
        $this->parser->set_object($this->listener);
        $this->parser->set_element_handler('startHandler', 'endHandler');
        $this->parser->set_data_handler('dataHandler');
        $this->parser->set_escape_handler('escapeHandler');
        $this->parser->set_pi_handler('piHandler');
        $this->parser->set_jasp_handler('jaspHandler');
    }
}
