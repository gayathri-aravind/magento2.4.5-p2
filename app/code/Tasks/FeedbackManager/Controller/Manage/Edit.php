<?php

namespace Tasks\FeedbackManager\Controller\Manage;

class Edit implements \Magento\Framework\App\ActionInterface
{
    protected $resultPageFactory;
    protected $feedbackFactory;
    protected $customerSession;
    protected $messageManager;
    protected $resultRedirectFactory;
    protected $request;
    protected $collectionFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory,
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->feedbackFactory = $feedbackFactory;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $feedbackId = $this->request->getParam('id');
        $customerId = $this->customerSession->getCustomerId();
        $isAuthorised = $this->collectionFactory->create()
                                    ->addFieldToFilter('user_id', $customerId)
                                    ->addFieldToFilter('entity_id', $feedbackId)
                                    ->getSize();
        if (!$isAuthorised) {
            $this->messageManager->addErrorMessage(__('You are not authorised to edit this feedback.'));
            return $this->resultRedirectFactory->create()->setPath('feedback/manage');
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Edit Feedback'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}
