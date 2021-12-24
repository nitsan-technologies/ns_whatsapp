<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        if (version_compare(TYPO3_branch, '10.0', '>=')) {
            $moduleClass = \Nitsan\NsWhatsapp\Controller\WhatsappController::class;
        } else {
            $moduleClass = 'Whatsapp';
        }
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Nitsan.NsWhatsapp',
            'Whatsapp',
            [
                $moduleClass => 'list, update, create',
            ],
            // non-cacheable actions
            [
                $moduleClass => 'update, create',
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
