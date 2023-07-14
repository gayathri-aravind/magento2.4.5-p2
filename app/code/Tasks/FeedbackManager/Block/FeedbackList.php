<?php

namespace Tasks\FeedbackManager\Block;

class FeedbackList extends \Magento\Framework\View\Element\Template
{
    protected $feedbackCollection;
    protected $customerSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $feedbackCollection,
        \Magento\Customer\Model\SessionFactory $customerSession,
        array $data = []
    ) {
        $this->feedbackCollection = $feedbackCollection;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getFeedbacks()
    {
        $customerId = $this->customerSession->create()->getCustomer()->getId();

        $collection = $this->feedbackCollection->create();
        $collection->addFieldToFilter('user_id', ['eq' => $customerId])
                    ->setOrder('updated_at', 'DESC');

        return $collection;
    }
}
