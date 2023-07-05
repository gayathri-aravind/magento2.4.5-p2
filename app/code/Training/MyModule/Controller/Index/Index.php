<?php

declare(strict_types=1);

namespace Training\MyModule\Controller\Index;

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
        return $page;

    }
}

?>