<?php

namespace Tasks\FeedbackManager\Controller\Manage;

class Save implements \Magento\Framework\App\ActionInterface
{
    protected $feedbackFactory;
    protected $customerSession;
    protected $messageManager;
    protected $resultRedirectFactory;
    protected $request;
    protected $collectionFactory;
    protected $feedback;

    public function __construct(
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback $feedback,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
        $this->feedback = $feedback;
    }

    public function execute()
    {
        $data = $this->request->getParams();
        $customerId = $this->customerSession->getCustomerId();

        $model = $this->feedbackFactory->create();

        if (!isset($data['id'])) {
            $model->setData($data);
            $model->setUserId($customerId);
            $this->feedback->save($model);
            $this->messageManager->addSuccessMessage(
                __('Feedback saved successfully.')
            );
            return $this->resultRedirectFactory->create()->setPath('/');
        }

        $isAuthorised = $this->collectionFactory->create()
                             ->addFieldToFilter('user_id', $customerId)
                             ->addFieldToFilter('entity_id', $data['id'])
                             ->getSize();

        if (!$isAuthorised) {
            $this->messageManager->addErrorMessage(
                __('You are not authorised to edit this feedback.')
            );
            return $this->resultRedirectFactory->create()->setPath('/');
        }

        $model->load($data['id']);
        $model->setCustomerFirstname($data['customer_firstname'])
              ->setCustomerLastname($data['customer_lastname'])
              ->setCustomerEmail($data['customer_email'])
              ->setComment($data['comment']);
        $this->feedback->save($model);
        $this->messageManager->addSuccessMessage(
            __('You have updated the feedback successfully.')
        );
        return $this->resultRedirectFactory->create()->setPath('/');
    }
}
