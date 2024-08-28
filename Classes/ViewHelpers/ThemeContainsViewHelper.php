<?php

namespace Nitsan\NsWhatsapp\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ThemeContainsViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument('value', 'string', '', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        return str_starts_with($arguments['value'], 'ns_whatsapp_');

    }
}
