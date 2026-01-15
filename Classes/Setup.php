<?php

namespace NITSAN\NsWhatsapp;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Package\PackageManager;
use NITSAN\NsLicense\Service\LicenseService;

/**
 * Setup
 */
class Setup
{
    protected $nsLicenseModule;

    public function executeOnSignal($extname = null): void
    {
        if (is_object($extname)) {
            $extname = $extname->getPackageKey();
        }

        if ($extname === 'ns_whatsapp') {
            // Let's check license system
            //@extensionScannerIgnoreLine
            $activePackages = GeneralUtility::makeInstance(PackageManager::class)->getActivePackages();
            $isLicenseCheck = false;
            foreach ($activePackages as $key => $value) {
                if ($key == 'ns_license') {
                    $isLicenseCheck = true;
                }
            }
            if($isLicenseCheck) {
                $this->nsLicenseModule = GeneralUtility::makeInstance(LicenseService::class);
                $this->nsLicenseModule->connectToServer($extname, 0);
            }
        }
    }
}
