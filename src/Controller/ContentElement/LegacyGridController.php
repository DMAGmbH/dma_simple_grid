<?php declare(strict_types=1);

namespace Dma\SimpleGrid\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use DMA\DmaSimpleGrid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(type: 'dma_simplegrid_wrapper_start', category: 'dma_simplegrid', template: 'content_element/simple_grid/legacy/wrapper_start')]
#[AsContentElement(type: 'dma_simplegrid_wrapper_stop', category: 'dma_simplegrid', template: 'content_element/simple_grid/legacy/wrapper_stop')]
#[AsContentElement(type: 'dma_simplegrid_row_start', category: 'dma_simplegrid', template: 'content_element/simple_grid/legacy/row_start')]
#[AsContentElement(type: 'dma_simplegrid_row_stop', category: 'dma_simplegrid', template: 'content_element/simple_grid/legacy/row_stop')]
#[AsContentElement(type: 'dma_simplegrid_column_start', category: 'dma_simplegrid', template: 'content_element/simple_grid/legacy/column_start')]
#[AsContentElement(type: 'dma_simplegrid_column_stop', category: 'dma_simplegrid', template: 'content_element/simple_grid/legacy/column_stop')]
class LegacyGridController extends AbstractContentElementController
{
    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        // Start/stop tags would otherwise break the backend document structure.
        if ($this->isBackendScope($request)) {
            return new Response();
        }

        if (str_ends_with($model->type, '_stop')) {
            return $template->getResponse();
        }

        $data = $model->row();
        [$legacyClass, $gridClasses] = match ($model->type) {
            'dma_simplegrid_wrapper_start' => ['ce_wrapper', DmaSimpleGrid::getWrapperClasses($data)],
            'dma_simplegrid_row_start' => ['ce_row', DmaSimpleGrid::getRowClasses($data)],
            'dma_simplegrid_column_start' => ['ce_column', ''],
        };

        $columnClasses = DmaSimpleGrid::hasDmaGridInfos($data) ? DmaSimpleGrid::getColumnClasses($data) : '';

        // Preserve the legacy class names and their order, including supplied classes.
        $cssClasses = [
            $legacyClass,
            $gridClasses,
            $template->get('element_css_classes'),
            $columnClasses,
        ];

        $template->set('legacy_css_classes', trim(implode(' ', $cssClasses)));

        return $template->getResponse();
    }
}
