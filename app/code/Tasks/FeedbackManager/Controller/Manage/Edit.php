<?php
namespace Tasks\FeedbackManager\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

class Edit extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $feedbackFactory;
    protected $customerSession;
    protected $messageManager;

    public function __construct(
        Context $context,
    PageFactory $resultPageFactory,
    \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
    Session $customerSession,
    \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->feedbackFactory = $feedbackFactory;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $feedbackId = $this->getRequest()->getParam('id');
        $customerId = $this->customerSession->getCustomerId();
        $isAuthorised = $this->feedbackFactory->create()
                                    ->getCollection()
                                    ->addFieldToFilter('user_id', $customerId)
                                    ->addFieldToFilter('entity_id', $feedbackId)
                                    ->getSize();
        if (!$isAuthorised) {
            $this->messageManager->addError(__('You are not authorised to edit this feedback.'));
            return $this->resultRedirectFactory->create()->setPath('feedback/manage');
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Edit Feedback'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}