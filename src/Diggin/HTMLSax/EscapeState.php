<?php


namespace Diggin\HTMLSax;

use Diggin\HTMLSax\StateInterface;

/**
 * Deals with Diggin escapes handling comments and CDATA correctly
 * @package Diggin_HTMLSax
 * @access protected
 */
class EscapeState
{
    /**
     * @param Diggin_HTMLSax_StateParser subclass
     * @return Diggin_HTMLSax_StateInterface::STATE_START
     * @access protected
     */
    function parse($context)
    {
        $char = $context->ScanCharacter();
        if ($char == '-') {
            $char = $context->ScanCharacter();
            if ($char == '-') {
                $context->unscanCharacter();
                $context->unscanCharacter();
                $text = $context->scanUntilString('-->');
                $text .= $context->scanCharacter();
                $text .= $context->scanCharacter();
            } else {
                $context->unscanCharacter();
                $text = $context->scanUntilString('>');
            }
        } elseif ($char == '[') {
            $context->unscanCharacter();
            $text = $context->scanUntilString(']>');
            $text .= $context->scanCharacter();
        } else {
            $context->unscanCharacter();
            $text = $context->scanUntilString('>');
        }

        $context->IgnoreCharacter();
        if ($text != '') {
            $context->handler_object_escape->
            {$context->handler_method_escape}($context->htmlsax, $text);
        }
        return StateInterface::STATE_START;
    }
}
