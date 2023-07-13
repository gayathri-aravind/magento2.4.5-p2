<?php
namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__("View Feedback"));
        return $resultPage;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tasks_FeedbackManager::view');
    }
}