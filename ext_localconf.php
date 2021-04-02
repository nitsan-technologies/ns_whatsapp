<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Nitsan.NsWhatsapp',
            'Whatsapp',
            [
                'Whatsapp' => 'list, update, create',
            ],
            // non-cacheable actions
            [
                'Whatsapp' => 'update, create',
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
    }
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Nitsan\\NsWhatsapp\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Nitsan\\NsWhatsapp\\Property\\TypeConverter\\ObjectStorageConverter');
