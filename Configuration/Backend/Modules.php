<?php

use Nitsan\NsWhatsapp\Controller\WhatsappController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use Nitsan\NsWhatsapp\Controller\NsConstantEditorController;

$module = [
    'nitsan_nswhatsappnitsan_configuration' => [
        'parent' => 'nitsan_module',
        'position' => ['before' => 'top'],
        'access' => 'user',
        'path' => '/module/nitsan/NsWhatsappWhatsappmodule',
        'icon'   => 'EXT:ns_whatsapp/Resources/Public/Icons/whats_app.svg',
        'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/BackendModule.xlf:configuration',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'extensionName' => 'NsWhatsapp',
        'routes' => [
            '_default' => [
                'target' => NsConstantEditorController::class . '::handleRequest',
            ],
        ],
        'moduleData' => [
            'selectedTemplatePerPage' => [],
            'selectedCategory' => '',
        ],
    ],
    'nitsan_nswhatsapp_constants' => [
        'parent' => 'nitsan_module',
        'position' => ['before' => 'top'],
        'access' => 'user',
        'path' => '/module/nitsan/NsWhatsappConstant/',
        'icon'   => 'EXT:ns_whatsapp/Resources/Public/Icons/whats_app.svg',
        'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/BackendModule.xlf:style',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
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
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'position' => ['after' => 'web'],
    ];
}

return $module;
