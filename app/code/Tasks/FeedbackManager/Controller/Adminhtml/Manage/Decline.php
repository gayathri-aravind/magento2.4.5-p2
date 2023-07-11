<?php
namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

use Magento\Backend\App\Action;
use Tasks\FeedbackManager\Helper\Sendmail;
use Magento\Backend\App\Action\Context;

class Decline extends Action
{
    protected $feedbackFactory;
    protected $mailer;
    
    public function __construct(
        Context $context,
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        Sendmail $mailer
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->mailer = $mailer;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        
        if (isset($id)) {
            
            try {
                $feedbackModel = $this->feedbackFactory->create();
                $feedbackModel->load($id);
                $feedbackModel->setData('status', 2)
                        ->save();
                
                // $mailStatus = $this->mailer->sendMail("feedback_decline_template" , (array)$feedbackModel->getData());
                // if ($mailStatus) { $this->messageManager->addSuccessMessage(__('Feedback decline status has sent to customer by email.')); }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tasks_FeedbackManager::decline');
    }
}