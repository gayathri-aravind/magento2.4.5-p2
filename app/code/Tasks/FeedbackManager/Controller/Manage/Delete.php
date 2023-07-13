<?php
namespace Tasks\FeedbackManager\Controller\Manage;

class Delete extends \Magento\Framework\App\Action\Action
{
    protected $feedbackFactory;
    protected $customerSession;
    protected $messageManager;
    protected $jsonData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Json\Helper\Data $jsonData
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->customerSession = $customerSession;
        $this->jsonData = $jsonData;
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
            $msg=__('You are not authorised to delete this feedback.');
            $success=0;
        } else {
            $model = $this->feedbackFactory->create()->load($feedbackId);
            $model->delete();
            $msg=__('You have successfully deleted the feedback.');
            $success=1;
        }     
        $this->getResponse()->setHeader('Content-type', 'application/javascript');
        $this->getResponse()->setBody(
            $this->jsonData->jsonEncode(
                    [
                        'success' => $success,
                        'message' => $msg
                    ]
                ));
    }
}