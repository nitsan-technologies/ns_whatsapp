<?php

namespace Nitsan\NsWhatsapp\ViewHelpers\Misc;

use Nitsan\NsWhatsapp\Utility\BackendUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * BackendEditLinkViewHelper
 *
 */
class BackendEditLinkViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument('tableName', 'string', '', true);
        $this->registerArgument('identifier', 'integer', '', true);
    }

    /**
     * Create a link for backend edit
     *
     * @return string
     */
    public function render()
    {
        return BackendUtility::createEditUri($this->arguments['tableName'], $this->arguments['identifier'], true);
    }
}
