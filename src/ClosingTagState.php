<?php


namespace Diggin\HTMLSax;

/**
 * Dealing with closing Diggin tags
 * @package Diggin_HTMLSax
 * @access protected
 */
class ClosingTagState
{
    /**
     * @param Diggin_HTMLSax_StateParser subclass
     * @return Diggin_HTMLSax_StateInterface::STATE_START
     * @access protected
     */
    function parse($context)
    {
        $tag = $context->scanUntilCharacters('/>');
        if ($tag != '') {
            $char = $context->scanCharacter();
            if ($char == '/') {
                $char = $context->scanCharacter();
                if ($char != '>') {
                    $context->unscanCharacter();
                }
            }
            $context->handler_object_element->
            {$context->handler_method_closing}($context->htmlsax, $tag, false);
        }

        return StateInterface::STATE_START;
    }
}
