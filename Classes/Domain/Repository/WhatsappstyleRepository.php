<?php

namespace Nitsan\NsWhatsapp\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/***
 *
 * This file is part of the "Whatsapp" Extension for TYPO3 CMS.
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
class WhatsappstyleRepository extends Repository
{
    /**
     * Initializes the repository
     */
    public function initializeObject(): void
    {
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @return QueryResultInterface|array
     */
    public function findAllstyle(): QueryResultInterface|array
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
        return $this->createQuery()->execute();
    }

    /**
     * @param int $uid_local
     * @param int $uid_foreign
     * @param int $pid
     * @param string $table
     * @param string $field
     * @param int $empty
     * @return void
     */
    public function updateSysFileReferenceRecord(
        int $uid_local,
        int $uid_foreign,
        int $pid,
        string $table,
        string $field,
        int $empty
    ): void {
        $tableConnectionCategoryMM = $this->getConnectionPool();
        if($empty == 0) {
            $tableConnectionCategoryMM->delete(
                'sys_file_reference',
                [ 'uid_foreign' => $uid_foreign ]
            );
        }
        $sysFileReferenceData[$uid_local] = [
            'uid_local' => $uid_local,
            'uid_foreign' => $uid_foreign,
            'tablenames' => $table,
            'fieldname' => $field,
            'sorting_foreign' => 1,
            'pid' => $pid
        ];

        if($empty == 1 && $uid_foreign == 6) {
            $tableConnectionCategoryMM->delete(
                'sys_file_reference',
                [ 'uid_foreign' => $uid_foreign ]
            );
        }
        if (!empty($sysFileReferenceData[$uid_local]['uid_local'])) {
            $tableConnectionCategoryMM->bulkInsert(
                'sys_file_reference',
                array_values($sysFileReferenceData),
                ['uid_local', 'uid_foreign', 'tablenames', 'fieldname', 'sorting_foreign', 'pid']
            );
        }
    }

    /**
     * @return Connection
     */
    private function getConnectionPool(): Connection
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('sys_file_reference');
    }
}
