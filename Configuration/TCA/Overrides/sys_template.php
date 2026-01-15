<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addStaticFile(
    'ns_whatsapp',
    'Configuration/TypoScript',
    'Whatsapp'
);
