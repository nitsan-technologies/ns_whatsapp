<?php

use Nitsan\NsWhatsapp\Controller\WhatsappController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

// @extensionScannerIgnoreLine
ExtensionUtility::configurePlugin(
    'NsWhatsapp',
    'Whatsapp',
    [
        WhatsappController::class => 'list, update, create',
    ],
    // non-cacheable actions
    [
        WhatsappController::class => 'update, create',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
);
