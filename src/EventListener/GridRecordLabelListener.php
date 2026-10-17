<?php declare(strict_types=1);

namespace Dma\SimpleGrid\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\StringUtil;
use Contao\System;
use DMA\DmaSimpleGrid;

class GridRecordLabelListener
{
    // Run after Contao has registered its service-based DCA callbacks (-16),
    // so the existing label_callback is wrapped instead of replaced.
    #[AsHook('loadDataContainer', priority: -256)]
    public function __invoke(string $table): void
    {
        if (!in_array($table, ['tl_content', 'tl_form_field'], true)) {
            return;
        }

        $callback = $GLOBALS['TL_DCA'][$table]['list']['label']['label_callback'] ?? null;

        $GLOBALS['TL_DCA'][$table]['list']['label']['label_callback'] = static function (array $row, string $label, ...$args) use ($callback): array|string {
            if (is_array($callback)) {
                $label = System::importStatic($callback[0])->{$callback[1]}($row, $label, ...$args);
            } elseif (is_callable($callback)) {
                $label = $callback($row, $label, ...$args);
            }

            $info = DmaSimpleGrid::getSimpleGridInfoText($row);

            if ($info === '') {
                return $label;
            }

            $info = StringUtil::specialchars($info);
            $info = ' [<span class="tl_gray" style="white-space:nowrap; max-width:200px; display:inline-block; overflow:hidden; text-overflow:ellipsis; vertical-align:bottom;" title="' . $info . '">' . $info . '</span>]';

            if (is_array($label)) {
                $label[0] = ($label[0] ?? '') . $info;

                return $label;
            }

            return $label . $info;
        };
    }
}
