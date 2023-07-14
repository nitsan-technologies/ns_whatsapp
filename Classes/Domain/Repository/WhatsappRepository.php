<?php
namespace Nitsan\NsWhatsapp\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/***
 *
 * This file is part of the "Ns Whatsapp" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020
 *
 ***/
/**
 * The repository for Whatsapps
 */
class WhatsappRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param array $pid
     * @return array
     */
    public function fetchConstants($pid)
    {
        //
        // Query Builder for Table: sys_template
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_template');

        // Get Constants of Row, where RM Registration is included
        $query = $queryBuilder
            ->select('constants')
            ->from('sys_template')
            ->where(
                $queryBuilder->expr()->like(
                    'pid',
                    $queryBuilder->createNamedParameter($pid)
                )
            );

        // Execute Query and Return the Query-Fetch
        $query = $queryBuilder->execute();
        return $query->fetch();
    }
}
