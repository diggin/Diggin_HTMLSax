<?php
namespace Diggin\HTMLSax;

/**
 * Deals with JASP/ASP markup
 * @package Diggin_HTMLSax
 * @access protected
 */
class JaspState
{
    /**
     * @param Diggin_HTMLSax_StateParser subclass
     * @return constant Diggin_HTMLSax_StateInterface::STATE_START
     * @access protected
     */
    function parse($context)
    {
        $text = $context->scanUntilString('%>');
        if ($text != '') {
            $context->handler_object_jasp->
            {$context->handler_method_jasp}($context->htmlsax, $text);
        }
        $context->IgnoreCharacter();
        $context->IgnoreCharacter();
        return StateInterface::STATE_START;
    }
}
