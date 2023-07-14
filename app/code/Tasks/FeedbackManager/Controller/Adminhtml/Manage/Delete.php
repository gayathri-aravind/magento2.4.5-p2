<?php

namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

class Delete extends \Magento\Backend\App\Action
{
    protected $feedbackFactory;
    protected $feedback;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback $feedback
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedback = $feedback;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        try {
            $feedbackModel = $this->feedbackFactory->create();
            $this->feedback->load($feedbackModel, $id, 'entity_id');
            $this->feedback->delete($feedbackModel);
            $this->messageManager->addSuccessMessage(__('You deleted the feedback.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tasks_FeedbackManager::delete');
    }
}
