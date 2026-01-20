<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle',
        'label' => 'heading',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'hideTable' => true,
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'heading,text,textcolor,bgcolor,height,border,size,font,animation,imageposition,style,bordercolor,htextcolor,hbgcolor,hboredrcolor,imageurl,upload',
        'iconfile' => 'EXT:ns_whatsapp/Resources/Public/Icons/tx_nswhatsapp_domain_model_whatsappstyle.gif',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'interface' => [
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_diffsource, hidden, heading, text, textcolor, bgcolor, height, border, size, font, image, animation, imageposition, style, bordercolor, htextcolor, hbgcolor, hboredrcolor, imageurl, upload, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'foreign_table' => 'sys_language',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'datetime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'datetime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'heading' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.heading',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'upload' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.upload',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'deleteImage' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.height',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.text',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'textcolor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.textcolor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bgcolor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.bgcolor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'height' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.height',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'border' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.border',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.size',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'font' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.font',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'Image for marker',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'jpg,jpeg,png,svg',
            ],
        ],
        'animation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.animation',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'imageposition' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.imageposition',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'style' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.style',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bordercolor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.bordercolor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'htextcolor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.htextcolor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'hbgcolor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.hbgcolor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'hboredrcolor' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.hboredrcolor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'imageurl' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_whatsapp/Resources/Private/Language/locallang_db.xlf:tx_nswhatsapp_domain_model_whatsappstyle.imageurl',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    ],
];
