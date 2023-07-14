<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {
        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'NsWhatsapp',
            'Whatsapp',
            [
                \Nitsan\NsWhatsapp\Controller\WhatsappController::class => 'list, update, create',
            ],
            // non-cacheable actions
            [
                \Nitsan\NsWhatsapp\Controller\WhatsappController::class => 'update, create',
            ]
        );

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'ns_whatsapp-plugin-whatsapp',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:ns_whatsapp/Resources/Public/Icons/user_plugin_whatsapp.svg']
        );

        $iconRegistry->registerIcon(
            'module-nswhatsapp',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:ns_whatsapp/Resources/Public/Icons/module-nitsan.svg']
        );

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.enforceContentSecurityPolicy'] = false;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.frontend.enforceContentSecurityPolicy'] = false;    
    }
);