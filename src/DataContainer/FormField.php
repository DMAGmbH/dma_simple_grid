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
use Contao\Input;
use Dma\DmaSimpleGrid\Config\GridConfig;
use Doctrine\DBAL\Connection;

class FormField
{
    public function __construct(
        private readonly Connection $connection,
    ) {
    }

    #[AsCallback(table: 'tl_form_field', target: 'config.onsubmit')]
    public function autoInsertWrapperStopElement(DataContainer $dc): void
    {
        $activeRecord = $dc->activeRecord;

        if (!$activeRecord || 'auto' === Input::post('SUBMIT_TYPE')) {
            return;
        }

        if ('dma_simplegrid_column_start' === $activeRecord->type) {
            // Find the next column stop element
            $nextColStopElement = $this->connection->fetchOne(
                'SELECT id FROM tl_form_field	WHERE pid = ? AND type = ? AND sorting > ? ORDER BY sorting',
                [
                    $activeRecord->pid,
                    'dma_simplegrid_column_stop',
                    $activeRecord->sorting,
                ]
            );

            // Check if a stop element should be inserted
            if (!$nextColStopElement) {
                $set = [
                    'pid' => $activeRecord->pid,
                    'type' => 'dma_simplegrid_column_stop',
                    'sorting' => $activeRecord->sorting + 1,
                    'tstamp' => time(),
                ];

                $this->connection->insert('tl_form_field', $set);
            }
        }

        if ('dma_simplegrid_row_start' === $activeRecord->type) {
            // Find the row stop element
            $nextRowStopElement = $this->connection->fetchOne(
                'SELECT id	FROM tl_form_field WHERE pid = ? AND type = ? AND sorting > ? ORDER BY sorting',
                [
                    $activeRecord->pid,
                    'dma_simplegrid_row_stop',
                    $activeRecord->sorting,
                ]
            );

            // Check if a stop element should be inserted
            if (!$nextRowStopElement) {
                $set = [
                    'pid' => $activeRecord->pid,
                    'type' => 'dma_simplegrid_row_stop',
                    'sorting' => $activeRecord->sorting + 1,
                    'tstamp' => time(),
                ];
                $this->connection->insert('tl_form_field', $set);
            }
        }
    }

    #[AsCallback(table: 'tl_form_field', target: 'fields.dma_simplegrid_additionalrowclasses.options')]
    public static function getAdditionalRowClasses(): array
    {
        GridConfig::initialize();
        $gridConfig = GridConfig::getDataAll();

        return $gridConfig['additional-classes']['row'] ?? [];
    }
}
