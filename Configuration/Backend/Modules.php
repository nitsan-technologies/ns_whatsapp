<?php

use Nitsan\NsWhatsapp\Controller\WhatsappController;

return [
    'nitsan_module' => [
        'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/BackendModule.xlf',
        'icon' => 'EXT:ns_whatsapp/Resources/Public/Icons/module-nswhatsapp.svg',
        'iconIdentifier' => 'module-nswhatsapp',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'position' => ['after' => 'web'],
    ],
    'nitsan_NsWhatsappWhatsappmodule' => [
        'parent' => 'nitsan_module',
        'position' => ['before' => 'top'],
        'access' => 'user',
        'path' => '/module/nitsan/NsWhatsappWhatsappmodule',
        'icon'   => 'EXT:ns_whatsapp/Resources/Public/Icons/whats_app.svg',
        'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_whastappmodule.xlf',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'extensionName' => 'NsWhatsapp',
        'controllerActions' => [
            WhatsappController::class => [
                'chatSettings', 
                'saveConstant',
                'update', 
                'styleSettings',
            ],
        ],
    ],
    
];