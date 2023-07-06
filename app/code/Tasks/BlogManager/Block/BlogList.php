<?php
namespace Tasks\BlogManager\Block;

use Magento\Customer\Model\SessionFactory;

class BlogList extends \Magento\Framework\View\Element\Template
{
    protected $blogCollection;
    protected $customerSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Tasks\BlogManager\Model\ResourceModel\Blog\CollectionFactory $blogCollection,
        SessionFactory $customerSession,
        array $data = []
    ) {
        $this->blogCollection = $blogCollection;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getBlogs()
    {
        $customerId = $this->customerSession->create()->getCustomer()->getId();

        // select * from blogmanager_blog where user_id = $customerId;
        $collection = $this->blogCollection->create();
        $collection->addFieldToFilter('user_id', ['eq'=>$customerId])
                   ->setOrder('updated_at', 'DESC'); // ORDER BY updated_at DESC

                //    $collection->getSelect();

        return $collection;
    }
}