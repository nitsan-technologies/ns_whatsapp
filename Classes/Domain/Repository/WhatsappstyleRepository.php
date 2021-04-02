<?php
namespace Nitsan\NsWhatsapp\Domain\Repository;

/***
 *
 * This file is part of the "NsWhatsapp" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021
 *
 ***/
/**
 * The repository for Whatsappstyles
 */
class WhatsappstyleRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Initializes the repository
     */
    public function initializeObject()
    {
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    public function findAllstyle()
    {
        $query = $this->createQuery();

        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
        return $this->createQuery()->execute();
    }
}
