<?php
defined('TYPO3') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ns_whatsapp', 'Configuration/TypoScript', '[NITSAN] Whatsapp');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nswhatsapp_domain_model_whatsapp', 'EXT:ns_whatsapp/Resources/Private/Language/locallang_csh_tx_nswhatsapp_domain_model_whatsapp.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nswhatsapp_domain_model_whatsapp');
