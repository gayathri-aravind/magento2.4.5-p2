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
        if (isset($data['id']) && $data['id']) { // Editing the form. Only in Edit form, we have 'id' set
            $isAuthorised = $this->collectionFactory->create()
                                        ->addFieldToFilter('user_id', $customerId)
                                        ->addFieldToFilter('entity_id', $data['id'])
                                        ->getSize();
            if (!$isAuthorised) {
                $this->messageManager->addErrorMessage(__('You are not authorised to edit this blog.'));
                return $this->resultRedirectFactory->create()->setPath('feedback/manage');
            } else {
                // select * from feedbackmanager_feedback where entity_id = 4
                $model = $this->feedbackFactory->create()->load($data['id']);
                // Updating the table based on the user inputs
                $model->setCustomerFirstname($data['customer_firstname'])
                        ->setCustomerLastname($data['customer_lastname'])
                        ->setCustomerEmail($data['customer_email'])
                    ->setComment($data['comment'])
                    ->save();
                $this->messageManager->addSuccessMessage(__('You have updated the feedback successfully.'));
            }
        } else {    // Adding the feedback.
            $model = $this->feedbackFactory->create();
            $model->setData($data);
            $model->setUserId($customerId);
            $this->feedback->save($model);
            $this->messageManager->addSuccessMessage(__('Feedback saved successfully.'));
        }
        return $this->resultRedirectFactory->create()->setPath('/');
    }
}
