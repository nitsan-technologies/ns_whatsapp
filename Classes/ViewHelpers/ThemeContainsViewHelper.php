<?php

namespace Nitsan\NsWhatsapp\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class ThemeContainsViewHelper extends AbstractViewHelper
{
    public function initializeArguments()  : void
    {
        $this->registerArgument('value', 'string', '', true);
    }

    public function render(): bool
    {
        return static::renderStatic(
            $this->arguments,
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        return str_starts_with($arguments['value'], 'ns_whatsapp_');

    }
}
