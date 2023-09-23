<?php

declare(strict_types=1);

/*
 * This file is part of Dma Simple Grid.
 *
 * (c) Janosch Oltmanns 2023 <kontakt@janosch-oltmanns.de>
 * @license LGPL-3.0+
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/DMAGmbH/dma_simple_grid
 */

namespace Dma\DmaSimpleGrid\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Dma\DmaSimpleGrid\Config\GridConfig;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RequestStack;

class Content
{
    public function __construct(
        private readonly Connection $connection,
        private readonly RequestStack $requestStack,
    ) {
    }

    #[AsCallback(table: 'tl_content', target: 'config.onsubmit')]
    public function autoInsertWrapperStopElement(DataContainer $dc): void
    {
        $activeRecord = $dc->activeRecord;

        $request = $this->requestStack->getCurrentRequest();

        if (!$activeRecord || 'auto' === $request->request->get('SUBMIT_TYPE')) {
            return;
        }

        if ('dma_simplegrid_column_start' === $activeRecord->type) {
            // Find the next column stop element
            $nextStopColElement = $this->connection->fetchOne(
                'SELECT id FROM tl_content WHERE pid = ? AND (ptable = ? OR ptable = ?) AND type = ? AND sorting > ? ORDER BY sorting',
                [
                    $activeRecord->pid,
                    $activeRecord->ptable ?: 'tl_article',
                    'tl_article' === $activeRecord->ptable ? '' : $activeRecord->ptable,
                    'dma_simplegrid_column_stop',
                    $activeRecord->sorting,
                ]
            );

            // Check if a stop element should be inserted
            if (!$nextStopColElement) {
                $set = [
                    'pid' => $activeRecord->pid,
                    'ptable' => $activeRecord->ptable ?: 'tl_article',
                    'type' => 'dma_simplegrid_column_stop',
                    'sorting' => $activeRecord->sorting + 1,
                    'tstamp' => time(),
                ];

                $this->connection->insert('tl_content', $set);
            }
        }

        if ('dma_simplegrid_row_start' === $activeRecord->type) {
            // Find the next row stop element
            $nextStopRowElement = $this->connection->fetchOne(
                'SELECT id FROM tl_content WHERE pid = ? AND (ptable = ? OR ptable = ?) AND type = ? AND sorting > ? ORDER BY sorting',
                [
                    $activeRecord->pid,
                    $activeRecord->ptable ?: 'tl_article',
                    'tl_article' === $activeRecord->ptable ? '' : $activeRecord->ptable,
                    'dma_simplegrid_row_stop',
                    $activeRecord->sorting,
                ]
            );

            // Check if a stop element should be inserted
            if (!$nextStopRowElement) {
                $set = [
                    'pid' => $activeRecord->pid,
                    'ptable' => $activeRecord->ptable ?: 'tl_article',
                    'type' => 'dma_simplegrid_row_stop',
                    'sorting' => $activeRecord->sorting + 1,
                    'tstamp' => time(),
                ];

                $this->connection->insert('tl_content', $set);
            }
        }

        if ('dma_simplegrid_wrapper_start' === $activeRecord->type) {
            // Find the next wrapper stop element
            $nextStopWrapperElement = $this->connection->fetchOne(
                'SELECT id FROM tl_content WHERE pid = ? AND (ptable = ? OR ptable = ?) AND type = ? AND sorting > ? ORDER BY sorting',
                [
                    $activeRecord->pid,
                    $activeRecord->ptable ?: 'tl_article',
                    'tl_article' === $activeRecord->ptable ? '' : $activeRecord->ptable,
                    'dma_simplegrid_wrapper_stop',
                    $activeRecord->sorting,
                ]
            );

            // Check if a stop element should be inserted
            if (!$nextStopWrapperElement) {
                $set = [
                    'pid' => $activeRecord->pid,
                    'ptable' => $activeRecord->ptable ?: 'tl_article',
                    'type' => 'dma_simplegrid_wrapper_stop',
                    'sorting' => $activeRecord->sorting + 1,
                    'tstamp' => time(),
                ];

                $this->connection->insert('tl_content', $set);
            }
        }
    }

    #[AsCallback(table: 'tl_content', target: 'fields.dma_simplegrid_additionalwrapperclasses.options')]
    public function getAdditionalWrapperClasses(): array
    {
        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        return $gridConfig['additional-classes']['wrapper'] ?? [];
    }

    #[AsCallback(table: 'tl_content', target: 'fields.dma_simplegrid_additionalcolumnclasses.options')]
    public static function getAdditionalColumnClasses(): array
    {
        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        return $gridConfig['additional-classes']['columns'] ?? [];
    }

    #[AsCallback(table: 'tl_content', target: 'fields.dma_simplegrid_additionalrowclasses.options')]
    public static function getAdditionalRowClasses(): array
    {
        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        return $gridConfig['additional-classes']['row'] ?? [];
    }
}
