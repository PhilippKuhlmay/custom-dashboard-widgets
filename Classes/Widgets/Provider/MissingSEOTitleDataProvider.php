<?php
declare(strict_types=1);

namespace Treupo\CustomDashboardWidgets\Widgets\Provider;

/*
 * (c) 2020 Treupo <typo3@treupo.de>
 *
 * This file is part of the Custom Dashboard Widgets Extension.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Type\Bitmask\Permission;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class MissingSEOTitleDataProvider implements PageProviderInterface
{
    /**
     * @var array
     */
    private $excludedDoktypes;

    /**
     * @var int
     */
    private $limit;

    public function __construct(array $excludedDoktypes, int $limit)
    {
        $this->excludedDoktypes = $excludedDoktypes;
        $this->limit = $limit ?: 5;
    }

    public function getPages(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');

        $constraints = [
            $queryBuilder->expr()->notIn('doktype', $this->excludedDoktypes),
            $queryBuilder->expr()->eq('no_index', 0),
            $queryBuilder->expr()->orX(
                $queryBuilder->expr()->eq('description', $queryBuilder->createNamedParameter('')),
                $queryBuilder->expr()->isNull('description')
            ),
        ];

        $items = [];
        $counter = 0;
        $iterator = 0;

        while ($counter < $this->limit) {
            $row = $queryBuilder
                ->select('*')
                ->from('pages')
                ->where(...$constraints)
                ->orderBy('tstamp', 'DESC')
                ->setFirstResult($iterator)
                ->setMaxResults(1)
                ->execute()
                ->fetch();

            $iterator++;

            if (!$this->getBackendUser()->doesUserHaveAccess($row, Permission::PAGE_SHOW)) {
                continue;
            }

            $items[] = $row;
            $counter++;
        }
        return $items;
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }
}
