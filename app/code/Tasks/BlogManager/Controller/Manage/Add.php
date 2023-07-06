<?php
namespace Tasks\BlogManager\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends AbstractAccount
{
    public function __construct(
        Context $context,
    PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
      echo('<h1>Hello World</h1>');
    }
}