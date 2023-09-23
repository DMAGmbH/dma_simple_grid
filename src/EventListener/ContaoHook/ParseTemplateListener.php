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

namespace Dma\DmaSimpleGrid\EventListener\ContaoHook;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Template;
use Dma\DmaSimpleGrid\DataContainer\DcaUtil;

#[AsHook('parseTemplate', priority: 100)]
class ParseTemplateListener
{
    public function __invoke(Template $objTemplate): void
    {
        if (DcaUtil::hasDmaGridInfos($objTemplate->getData())) {
            $objTemplate->class .= ' '.DcaUtil::getColumnClasses($objTemplate->getData());
        }
    }
}
