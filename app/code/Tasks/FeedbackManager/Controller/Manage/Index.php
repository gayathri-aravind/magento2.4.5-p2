<?php

namespace Tasks\FeedbackManager\Controller\Manage;

class Index implements \Magento\Framework\App\ActionInterface
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
        $resultPage->getConfig()->getTitle()->set(__('Feedbacks'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}
