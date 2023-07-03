<?php

declare(strict_types=1);

namespace Training\DependencyExample\Controller\Index;

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
        $page = $this->resultFactory->create();
        $page->getConfig()->getTitle()->set('Dependency Injection in Magento 2');
        return $page;

    }
}

?>