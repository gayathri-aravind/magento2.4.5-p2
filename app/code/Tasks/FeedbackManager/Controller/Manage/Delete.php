<?php

namespace Tasks\FeedbackManager\Controller\Manage;

class Delete implements \Magento\Framework\App\ActionInterface
{
    protected $feedbackFactory;
    protected $customerSession;
    protected $messageManager;
    protected $jsonData;
    protected $request;
    protected $collectionFactory;
    protected $feedback;
    protected $response;

    public function __construct(
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback $feedback,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\App\ResponseInterface $response,
        \Magento\Framework\Serialize\Serializer\Json $jsonData
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->customerSession = $customerSession;
        $this->jsonData = $jsonData;
        $this->request = $request;
        $this->response = $response;
        $this->collectionFactory = $collectionFactory;
        $this->feedback = $feedback;
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
            $msg = __('You are not authorised to delete this feedback.');
            $success = 0;
        } else {
            $model = $this->feedbackFactory->create();
            $this->feedback->load($model, $feedbackId, 'entity_id');
            $this->feedback->delete($model);
            $msg = __('You have successfully deleted the feedback.');
            $success = 1;
        }
        $this->getResponse()->setHeader('Content-type', 'application/javascript');
        $this->getResponse()->setBody(
            $this->jsonData->serialize(
                [
                'success' => $success,
                'message' => $msg
                ]
            )
        );
    }
}
