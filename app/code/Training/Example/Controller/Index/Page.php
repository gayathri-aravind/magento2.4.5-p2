<?php

declare(strict_types=1);

namespace Training\Example\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Page implements ActionInterface
{

    protected $pageFactory;

    public function __construct(PageFactory $pageFactory)
    {

        $this->pageFactory = $pageFactory;

    }

    public function execute()
    {
        // $this->pageFactory->create() - creates a new instance of the Magento\Framework\View\Result\PageFactory class.
        $page = $this->pageFactory->create();
        // Sets the title for your page in the menu and in the page
        $page->getConfig()->getTitle()->set('Your Page Title');
        return $page;

    }
}

?>