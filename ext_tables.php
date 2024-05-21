<?php

// TYPO3 Security Check
defined('TYPO3_MODE') or die();

$_EXTKEY = $GLOBALS['_EXTKEY'] = 'ns_whatsapp';

//Add Modules
// @extensionScannerIgnoreLine
if (TYPO3_MODE === 'BE') {
    $isVersion9Up = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 9000000;

    if (version_compare(TYPO3_branch, '8.0', '>=')) {

        // Add module 'nitsan' after 'Web'
        if (!isset($GLOBALS['TBE_MODULES']['nitsan'])) {
            $temp_TBE_MODULES = [];
            foreach ($GLOBALS['TBE_MODULES'] as $key => $val) {
                if ($key == 'web') {
                    $temp_TBE_MODULES[$key] = $val;
                    $temp_TBE_MODULES['nitsan'] = '';
                } else {
                    $temp_TBE_MODULES[$key] = $val;
                }
            }
            $GLOBALS['TBE_MODULES'] = $temp_TBE_MODULES;
            $GLOBALS['TBE_MODULES']['_configuration']['nitsan'] = [
                'iconIdentifier' => 'module-nswhatsapp',
                'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/BackendModule.xlf',
                'name' => 'nitsan',
            ];
        }

        if (version_compare(TYPO3_branch, '11.0', '>=')) {
            $moduleClass = \Nitsan\NsWhatsapp\Controller\WhatsappController::class;
        } else {
            $moduleClass = 'Whatsapp';
        }
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Nitsan.NsWhatsapp',
            'nitsan', // Make module a submodule of 'nitsan'
            'whatsappmodule', // Submodule key
            '', // Position
            [
                $moduleClass => 'chatSettings,saveConstant, update, styleSettings',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:ns_whatsapp/Resources/Public/Icons/whats_app.svg',
                'labels' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_whastappmodule.xlf',
                'navigationComponentId' => ($isVersion9Up ? 'TYPO3/CMS/Backend/PageTree/PageTreeElement' : 'typo3-pagetree'),
                'inheritNavigationComponentFromMainModule' => false,
            ]
        );
    }
}
