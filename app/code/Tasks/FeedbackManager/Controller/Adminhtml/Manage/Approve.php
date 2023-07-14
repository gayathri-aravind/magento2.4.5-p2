<?php

namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

class Approve extends \Magento\Backend\App\Action
{
    protected $feedbackFactory;
    protected $mailer;
    protected $feedback;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback $feedback,
        \Tasks\FeedbackManager\Helper\Sendmail $mailer
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->mailer = $mailer;
        $this->feedback = $feedback;
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
                $feedbackModel->setData('status', 1);
                $this->feedback->save($feedbackModel);
                $mailStatus = $this->mailer->sendMail("feedback_accept_template", (array)$feedbackModel->getData());
                if ($mailStatus) {
                     $this->messageManager->addSuccessMessage(
                         __('Customer notified on his/her feedback approve status.')
                     );
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tasks_FeedbackManager::approve');
    }
}
