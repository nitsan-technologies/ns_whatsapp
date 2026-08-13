<?php

use Nitsan\NsWhatsapp\Controller\WhatsappController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Information\Typo3Version;

if ((GeneralUtility::makeInstance(Typo3Version::class))->getMajorVersion() == 12) {
    $navigationComponent = '@typo3/backend/page-tree/page-tree-element';
} else {
    $navigationComponent = '@typo3/backend/tree/page-tree-element';
}

/**
 * Parent NITSAN module must always be registered here.
 * EXT:ns_basetheme currently does not register nitsan_module (commented out),
 * so guarding with isLoaded('ns_basetheme') hid this module whenever basetheme was active.
 */
return [
    'nitsan_module' => [
        'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/BackendModule.xlf',
        'iconIdentifier' => 'module-nswhatsapp',
        'navigationComponent' => $navigationComponent,
        'position' => ['after' => 'web'],
    ],
    'nitsan_nswhatsapp_constants' => [
        'parent' => 'nitsan_module',
        'position' => ['before' => 'top'],
        'access' => 'user',
        'path' => '/module/nitsan/NsWhatsappConstant/',
        'icon' => 'EXT:ns_whatsapp/Resources/Public/Icons/whats_app.svg',
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
