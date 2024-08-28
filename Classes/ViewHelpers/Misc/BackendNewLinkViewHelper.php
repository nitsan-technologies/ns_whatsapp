<?php

namespace Nitsan\NsWhatsapp\ViewHelpers\Misc;

use Nitsan\NsWhatsapp\Utility\BackendUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * BackendNewLinkViewHelper
 *
 */
class BackendNewLinkViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument('tableName', 'string', '', true);
        $this->registerArgument('identifier', 'integer', '', true);
    }

    /**
     * Create a link for backend new
     *
     * @return string
     */
    public function render()
    {
        return BackendUtility::createNewUri($this->arguments['tableName'], $this->arguments['identifier'], true);
    }
}
