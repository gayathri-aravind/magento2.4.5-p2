<?php

namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

class Index extends \Magento\Backend\App\Action
{
    protected $context;

    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tasks_FeedbackManager::manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Feedback'));
        return $resultPage;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tasks_FeedbackManager::manage');
    }
}
