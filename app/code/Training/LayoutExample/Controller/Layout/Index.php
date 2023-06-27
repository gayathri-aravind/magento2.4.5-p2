<?php

declare(strict_types=1);

namespace Training\LayoutExample\Controller\Layout;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{

    protected $resultFactory;

    public function __construct(PageFactory $resultFactory)
    {

        $this->resultFactory = $resultFactory;

    }

    public function execute()
    {
        // $this->resultFactory->create() - creates a new instance of the Magento\Framework\View\Result\PageFactory class.
        /*
        $result = $this->resultFactory->create();
        $result->getConfig()->getTitle()->set("Dynamic Webpage TAB content goes here");
        // $result->getLayout() will access the entire content of the layout file "layout_example_layout_index.xml" and then getBlock('page.main.title') points to the <referenceBlock name="page.main.title"> .. . </referenceBlock> and then overrides the page title
        $result->getLayout()->getBlock('page.main.title')->setPageTitle("Dynamic Webpage TITLE content goes here");
        return $result;
        */

        return $this->resultFactory->create();

    }
}

?>