<?php

namespace Nitsan\NsWhatsapp\Event;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Authentication\Event\AfterUserLoggedInEvent;
use TYPO3\CMS\Core\Package\PackageManager;
use NITSAN\NsLicense\Service\LicenseService;

/**
 * BackendUserLogin
 */
class BackendUserLogin
{
    public function dispatch(AfterUserLoggedInEvent $backendUser): void
    {
        // Let's check license system
        $isLicenseActivate = GeneralUtility::makeInstance(PackageManager::class)->isPackageActive('ns_license');
        if ($isLicenseActivate) {
            $nsLicenseModule =  GeneralUtility::makeInstance(LicenseService::class);
            $nsLicenseModule->connectToServer('ns_whatsapp', 0);
        }
    }
}
