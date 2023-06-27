<?php

declare(strict_types=1);

namespace Training\LayoutExample\Block\Layout;

use Magento\Framework\View\Element\Template;

class Index extends Template
{

    // NOTE: Got the method _prepareLayout() from the magento file: vendor/magento/module-catalog/Block/Category/View.php
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // Since this block is used within the layout file (layout_example_layout_index.xml), $this->getLayout() will get access to the contents of the file - layout_example_layout_index.xml

        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle('Page Title set from custom Block');
        }

        return $this;

    }

    public function getSubTitle(): string
    {
        return 'Page SubTitle from custom Block';

    }

    public function getNodeHtml(): string
    {
        // Since this block is used within the layout file (layout_example_layout_index.xml), $this->getLayout() will get access to the contents of the file - layout_example_layout_index.xml
        //createBlock(<Custom Block Name>::class) - method that creates a block on the fly.
        return $this->getLayout()->createBlock(Note::class)->toHtml();
    }
    
}

?>