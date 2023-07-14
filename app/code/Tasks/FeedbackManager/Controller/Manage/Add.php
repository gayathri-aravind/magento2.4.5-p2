<?php

namespace Tasks\FeedbackManager\Controller\Manage;

class Add implements \Magento\Framework\App\ActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Add Feedback'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}
