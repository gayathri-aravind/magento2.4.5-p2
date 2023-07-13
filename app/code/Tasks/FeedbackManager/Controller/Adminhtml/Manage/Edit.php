<?php
namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__("Edit Feedback"));
        return $resultPage;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tasks_FeedbackManager::edit');
    }
}