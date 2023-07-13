<?php

namespace Tasks\FeedbackManager\Controller\Manage;

class Save extends \Magento\Framework\App\Action\Action
{

    protected $feedbackFactory;
    protected $customerSession;
    protected $messageManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context, 
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory, 
        \Magento\Customer\Model\Session $customerSession, 
        \Magento\Framework\Message\ManagerInterface $messageManager)
    {
        $this->feedbackFactory = $feedbackFactory;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute(){
        $data = $this->getRequest()->getParams();
        $customerId = $this->customerSession->getCustomerId();
        if (isset($data['id']) && $data['id']) { // Editing the form. Only in Edit form, we have 'id' set
            $isAuthorised = $this->feedbackFactory->create()
                                        ->getCollection()
                                        ->addFieldToFilter('user_id', $customerId)
                                        ->addFieldToFilter('entity_id', $data['id'])
                                        ->getSize();
            if (!$isAuthorised) {
                $this->messageManager->addError(__('You are not authorised to edit this blog.'));
                return $this->resultRedirectFactory->create()->setPath('feedback/manage');
            } else {
                $model = $this->feedbackFactory->create()->load($data['id']); // select * from feedbackmanager_feedback where entity_id = 4
                // Updating the table based on the user inputs
                $model->setCustomerFirstname($data['customer_firstname'])
                        ->setCustomerLastname($data['customer_lastname'])
                        ->setCustomerEmail($data['customer_email'])
                    ->setComment($data['comment'])
                    ->save();
                $this->messageManager->addSuccess(__('You have updated the feedback successfully.'));
            }
        } else {    // Adding the feedback.
            $model = $this->feedbackFactory->create();
            $model->setData($data);
            $model->setUserId($customerId);
            $model->save();
            $this->messageManager->addSuccess(__('Feedback saved successfully.'));
        }        
        return $this->resultRedirectFactory->create()->setPath('/');

    }
}