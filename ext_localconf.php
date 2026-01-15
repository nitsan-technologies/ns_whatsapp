<?php

use Nitsan\NsWhatsapp\Controller\WhatsappController;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

ExtensionUtility::configurePlugin(
    'NsWhatsapp',
    'Whatsapp',
    [
        WhatsappController::class => 'list, update, create',
    ],
    // non-cacheable actions
    [
        WhatsappController::class => 'update, create',
    ]
);

$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);

$iconRegistry->registerIcon(
    'ns_whatsapp-plugin-whatsapp',
    SvgIconProvider::class,
    ['source' => 'EXT:ns_whatsapp/Resources/Public/Icons/user_plugin_whatsapp.svg']
);

$iconRegistry->registerIcon(
    'module-nswhatsapp',
    SvgIconProvider::class,
    ['source' => 'EXT:ns_whatsapp/Resources/Public/Icons/module-nitsan.svg']
);
