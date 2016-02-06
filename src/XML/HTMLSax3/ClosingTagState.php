<?php

/**
 * Dealing with closing XML tags
 * @package XML_HTMLSax3
 * @access protected
 */
class XML_HTMLSax3_ClosingTagState {
    /**
     * @param XML_HTMLSax3_StateParser subclass
     * @return XML_HTMLSax3_StateInterface::STATE_START
     * @access protected
     */
    function parse($context) {
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
            {$context->handler_method_closing}($context->htmlsax, $tag, FALSE);
        }

        return XML_HTMLSax3_StateInterface::STATE_START;
    }
}