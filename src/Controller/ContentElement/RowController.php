<?php declare(strict_types=1);

namespace Dma\SimpleGrid\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use DMA\DmaSimpleGrid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(
    type: 'dma_simplegrid_row',
    category: 'dma_simplegrid',
    template: 'content_element/simple_grid/row',
    nestedFragments: true,
)]
class RowController extends AbstractContentElementController
{
    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $template->set('grid_classes', DmaSimpleGrid::getRowClasses($model->row()));

        return $template->getResponse();
    }
}
