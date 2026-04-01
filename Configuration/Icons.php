<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'ns_whatsapp-plugin-whatsapp' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:ns_whatsapp/Resources/Public/Icons/user_plugin_whatsapp.svg',
    ],
    'module-nswhatsapp' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:ns_whatsapp/Resources/Public/Icons/module-nitsan.svg',
    ],
];
