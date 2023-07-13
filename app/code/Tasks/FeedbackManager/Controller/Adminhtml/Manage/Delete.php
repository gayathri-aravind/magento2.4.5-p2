<?php
namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

class Delete extends \Magento\Backend\App\Action
{
    protected $feedbackFactory;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory
    ) {
        $this->feedbackFactory = $feedbackFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        try {
            $feedbackModel = $this->feedbackFactory->create();
            $feedbackModel->load($id);
            $feedbackModel->delete();
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