<?php

use Nitsan\NsWhatsapp\Controller\WhatsappController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Information\Typo3Version;

if ((GeneralUtility::makeInstance(Typo3Version::class))->getMajorVersion() == 12) {
    $navigationComponent = '@typo3/backend/page-tree/page-tree-element';
} else {
    $navigationComponent = '@typo3/backend/tree/page-tree-element';
}

$module = [
    'nitsan_nswhatsapp_constants' => [
        'parent' => 'nitsan_module',
        'position' => ['before' => 'top'],
        'access' => 'user',
        'path' => '/module/nitsan/NsWhatsappConstant/',
        'icon'   => 'EXT:ns_whatsapp/Resources/Public/Icons/whats_app.svg',
        'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/WhatsappStyle.xlf',
        'navigationComponent' => $navigationComponent,
        'extensionName' => 'NsWhatsapp',
        'controllerActions' => [
            WhatsappController::class => [
                'styleSettings', 
                'update',                
            ],
        ],
    ],
];

if (!ExtensionManagementUtility::isLoaded('ns_basetheme')) {
    $module['nitsan_module'] = [
        'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/BackendModule.xlf',
        'iconIdentifier' => 'module-nswhatsapp',
        'navigationComponent' => $navigationComponent,
        'position' => ['after' => 'web'],
    ];
}

return $module;
