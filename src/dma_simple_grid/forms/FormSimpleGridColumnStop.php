<?php
/*
 * Copyright DMA GmbH and Janosch Oltmanns
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DMA;
/**
 * SimpleGrid row start content element
 *
 * @author Janosch Oltmanns <oltmanns@dma.do>
 */
class FormSimpleGridColumnStop extends \Widget
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'form_dma_simplegrid_columnstop';


    /**
     * Do not validate
     */
    public function validate()
    {
        return;
    }


    /**
     * Parse the template file and return it as string
     *
     * @param array $arrAttributes An optional attributes array
     *
     * @return string The template markup
     */
    public function parse($arrAttributes=null)
    {
        if (version_compare(VERSION, '4.0', '>=') && TL_MODE === 'BE') {
            /** @var \Contao\BackendTemplate|object $objTemplate */
            $objTemplate = new \Contao\BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . \Patchwork\Utf8::strtoupper($GLOBALS['TL_LANG']['FFL']['dma_simplegrid_column_stop'][0]) . ' ###';

            return $objTemplate->parse();
        }

        return parent::parse($arrAttributes);
    }


    /**
     * Generate the widget and return it as string
     *
     * @return string The widget markup
     */
    public function generate()
    {
        return "";
    }

}
